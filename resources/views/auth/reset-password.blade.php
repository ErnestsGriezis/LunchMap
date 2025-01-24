@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <section class="vh-100 reset-password-page d-flex align-items-center justify-content-center position-relative"
        style="background: url('{{ asset('images/here-background.jpg') }}') center/cover no-repeat;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100"
            style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
        <div class="container d-flex justify-content-center align-items-center h-100 position-relative" style="z-index: 2;">
            <div class="reset-password-card col-lg-6 shadow-lg p-5 text-white">
                <h2 class="text-center mb-3">Reset Your Password</h2>
                <p class="text-center">Enter your new password below.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required autofocus>
                        </div>
                        @error('email')
                            <div class="text-danger"><small><strong>{{ $message }}</strong></small></div>
                        @enderror
                    </div>

                    <!-- New Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                        </div>
                        @error('password')
                            <div class="text-danger"><small><strong>{{ $message }}</strong></small></div>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg">Reset Password</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
