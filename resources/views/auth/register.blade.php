@extends('layouts.auth')

@section('title', 'Đăng ký')

@section('content')
<div class="container" style="margin: 40px auto;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-form-box" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2 class="text-center" style="font-size: 24px; margin-bottom: 30px; color: #333;">
                    Đăng ký tài khoản
                </h2>

                <form action="{{ route('register.post') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name" style="font-weight: 500; color: #555;">Họ và tên</label>
                        <input id="name" name="name" type="text" required
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập họ và tên của bạn">
                        @error('name')
                            <span class="text-danger" style="font-size: 14px;">
                                <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="email" style="font-weight: 500; color: #555;">Email</label>
                        <input id="email" name="email" type="email" required
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập địa chỉ email">
                        @error('email')
                            <span class="text-danger" style="font-size: 14px;">
                                <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="password" style="font-weight: 500; color: #555;">Mật khẩu</label>
                        <input id="password" name="password" type="password" required
                            class="form-control @error('password') is-invalid @enderror"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập mật khẩu">
                        
                        <div style="margin-top: 8px; font-size: 13px; color: #666;">
                            <p style="margin-bottom: 5px;">Mật khẩu phải có:</p>
                            <ul style="list-style: none; padding-left: 0;">
                                <li style="margin-bottom: 3px;">
                                    <i class="fa fa-check-circle" style="color: #4CAF50; margin-right: 5px;"></i>
                                    Ít nhất 8 ký tự
                                </li>
                                <li style="margin-bottom: 3px;">
                                    <i class="fa fa-check-circle" style="color: #4CAF50; margin-right: 5px;"></i>
                                    Ít nhất 1 chữ hoa và 1 chữ thường
                                </li>
                                <li style="margin-bottom: 3px;">
                                    <i class="fa fa-check-circle" style="color: #4CAF50; margin-right: 5px;"></i>
                                    Ít nhất 1 số
                                </li>
                                <li style="margin-bottom: 3px;">
                                    <i class="fa fa-check-circle" style="color: #4CAF50; margin-right: 5px;"></i>
                                    Ít nhất 1 ký tự đặc biệt
                                </li>
                            </ul>
                        </div>

                        @error('password')
                            <span class="text-danger" style="font-size: 14px;">
                                <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-top: 15px;">
                        <label for="password_confirmation" style="font-weight: 500; color: #555;">Xác nhận mật khẩu</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="form-control"
                            style="height: 42px; border-radius: 4px;"
                            placeholder="Nhập lại mật khẩu">
                    </div>

                    @if (session('error'))
                        <div class="text-danger" style="margin: 15px 0; font-size: 14px;">
                            <i class="fa fa-exclamation-circle" style="margin-right: 5px;"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <button type="submit" 
                        class="btn btn-primary btn-block" 
                        style="margin-top: 15px; height: 42px; font-size: 15px; font-weight: 500;">
                        Đăng ký
                    </button>

                    <div class="text-center" style="margin: 20px 0;">
                        <span style="color: #666;">Đã có tài khoản? </span>
                        <a href="{{ route('login') }}" style="color: #2F80ED; font-weight: 500;">
                            Đăng nhập ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection