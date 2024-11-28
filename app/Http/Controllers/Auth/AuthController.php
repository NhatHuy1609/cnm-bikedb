<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Utils\Validation;
use Illuminate\Support\Facades\Password as PasswordBroker;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['verify', 'resend', 'showVerifyNotice']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            Validation::validateLoginCredentials($request->all()),
            Validation::loginMessages()
        );

        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && !$user->email_verified_at) {
            return back()
                ->withErrors(['email' => 'Please verify your email address before logging in.'])
                ->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($user->role_id == 1) { 
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()
            ->withErrors(['error' => 'Không tìm thấy tài khoản.'])
            ->withInput($request->only('email'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate(
                Validation::validateRegisterCredentials($request->all()),
                Validation::messages(),
                Validation::attributes()
            );

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 2 // Normal user role
            ]);

            event(new Registered($user));
            
            Auth::login($user);
            
            DB::commit();
            
            return redirect()->route('verification.notice');

        } catch (ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->errors())  // Trả về các lỗi validation
                ->withInput($request->except('password'));
            
        } catch (Exception $e) {
            DB::rollBack();
            // Log lỗi nếu cần
            
            return back()
                ->withErrors(['error' => 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.'])
                ->withInput($request->except('password'));
        }
    }

    public function showVerifyNotice()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function checkVerificationStatus(Request $request)
    {
        return response()->json([
            'verified' => $request->user()->hasVerifiedEmail()
        ]);
    }


    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = PasswordBroker::sendResetLink(
            $request->only('email')
        );

        return $status === PasswordBroker::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required', 
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);

        $status = PasswordBroker::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === PasswordBroker::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)
                ->orWhere(function($query) use ($googleUser) {
                    $query->where('provider', 'google')
                        ->where('provider_id', $googleUser->id);
                })->first();
                
            if ($user) {
                $user->update([
                    'name' => $googleUser->name,
                    'provider' => 'google',
                    'provider_id' => $googleUser->id,
                    'email_verified_at' => now(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'provider' => 'google',
                    'provider_id' => $googleUser->id,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);
            
            return $user->role_id == 1 
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
            
        } catch (Exception $e) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Google authentication failed. Please try again.']);
        }
    }

    public function deleteUnverifiedAccount(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $user = $request->user();
            
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            $user->delete();
            
            return redirect()->route('register')
                ->with('status', 'Your account has been deleted. You can now register with a different email.');
        }
        
        return back()->with('error', 'Cannot delete verified account.');
    }
}
