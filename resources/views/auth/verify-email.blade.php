<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Verify Your Email Address
                </h2>
                <div class="mb-4 text-sm text-gray-600 text-center">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="flex flex-col items-center space-y-6">
                <form method="POST" action="{{ route('verification.send') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 
                                   transition-colors text-sm font-semibold">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form action="{{ route('account.delete') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-sm text-gray-600 hover:text-gray-900 underline 
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 
                                   focus:ring-indigo-500 transition-all">
                        {{ __('Change Email Address') }}
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="inline-block w-4 h-4 ml-1" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke="currentColor">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 