@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="container" style="margin: 40px auto;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form-box" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2 class="text-center" style="font-size: 24px; margin-bottom: 30px; color: #333;">
                    Đăng nhập tài khoản
                </h2>

                <form action="{{ route('login.post') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="email" style="font-weight: 500; color: #555;">Email</label>
                        <input id="email" name="email" type="email" required 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập email của bạn">
                        @error('email')
                            <span class="help-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" style="font-weight: 500; color: #555;">Mật khẩu</label>
                        <input id="password" name="password" type="password" required 
                            class="form-control @error('password') is-invalid @enderror"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập mật khẩu">
                        @error('password')
                            <span class="help-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (session('error'))
                        <div class="text-danger" style="margin: 10px 0; font-size: 14px;">
                            <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group text-right">
                        <a href="{{ route('password.request') }}" class="forgot-password" style="color: #2F80ED; font-size: 14px;">
                            Quên mật khẩu?
                        </a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" style="height: 42px; font-size: 15px; font-weight: 500;">
                            Đăng nhập
                        </button>
                    </div>

                    <div class="text-center" style="margin: 20px 0;">
                        <span style="color: #666; position: relative; padding: 0 10px; background: #fff;">
                            Hoặc đăng nhập bằng
                        </span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('google.login') }}" class="btn btn-default btn-block" style="height: 42px; border: 1px solid #ddd;">
                            <img src="https://www.google.com/favicon.ico" alt="Google" style="width: 18px; height: 18px; margin-right: 8px; vertical-align: middle;">
                            <span style="vertical-align: middle; color: #555;">Tiếp tục với Google</span>
                        </a>
                    </div>

                    <div class="text-center" style="margin-top: 20px;">
                        <span style="color: #666;">Chưa có tài khoản? </span>
                        <a href="{{ route('register') }}" style="color: #2F80ED; font-weight: 500;">
                            Đăng ký ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection