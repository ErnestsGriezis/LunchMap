@extends('layouts.app') <!-- Extends the main layout -->

@section('title', 'Login') <!-- Set the page title -->

@section('content')
    <section class="vh-100 login-page" style="background-image: url('{{ asset('images/here-background.jpg') }}');">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);">
        </div>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">

                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Log in</p>

                                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('login') }}" novalidate>
                                        @csrf

                                        <!-- Email Field -->
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Your Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required autofocus />
                                            </div>
                                            @error('email')
                                                <div class="text-danger">
                                                    <small><strong>{{ $message }}</strong></small>
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Password Field -->
                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <input type="password" id="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror" required />
                                            </div>
                                            @error('password')
                                                <div class="text-danger">
                                                    <small><strong>{{ $message }}</strong></small>
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Forgot Password Link -->
                                        <div class="text-end mb-4">
                                            <a href="#" class="text-muted">Forgot Password?</a>
                                        </div>

                                        <!-- Remember Me Checkbox -->
                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input class="form-check-input me-2" type="checkbox" id="remember"
                                                name="remember" />
                                            <label class="form-check-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>

                                        <!-- Login Button -->
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Log in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
