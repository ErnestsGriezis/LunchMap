@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <section class="vh-100 forgot-password-page d-flex align-items-center justify-content-center position-relative"
        style="background: url('{{ asset('images/here-background.jpg') }}') center/cover no-repeat;">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100"
            style="background-color: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
        <div class="container d-flex justify-content-center align-items-center h-100 position-relative" style="z-index: 2;">
            <div class="forgot-password-card col-lg-6 shadow-lg p-5 text-white">
                <h2 class="text-center mb-3">Forgot Password</h2>
                <p class="text-center">Enter your email to reset your password.</p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

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

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg">
                            Send Password Reset Link
                        </button>
                    </div>

                </form>

                <!-- Back to Login -->
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-light">Back to Login</a>
                </div>
            </div>
        </div>
    </section>
@endsection
