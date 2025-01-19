@extends('layouts.app') <!-- Extends the main layout -->

@section('title', 'Register') <!-- Set the page title -->

@section('content')
    <section class="min-vh-100 d-flex align-items-center register-page"
        style="background-image: url('{{ asset('images/here-background.jpg') }}');">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.6);">
        </div>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card register-card pr-1">
                        <div class="card-body pt-1 pb-1">

                            <div class="row g-0">
                                <div class="col-md-6 p-5 d-flex flex-column justify-content-center register-form ">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="POST" action="{{ route('register') }}" novalidate>
                                        @csrf

                                        <!-- Name Field -->

                                        <div class="mb-4">
                                            <label class="form-label" for="name">Your Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" required autofocus />
                                                @error('name')
                                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email Field -->

                                        <div class="mb-4">
                                            <label class="form-label" for="email">Your Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required />
                                                @error('email')
                                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Password Field -->

                                        <div class="mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <input type="password" id="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror" required />
                                                @error('password')
                                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Confirm Password Field -->

                                        <div class="mb-4">
                                            <label class="form-label" for="password_confirmation">Repeat Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    required />
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Role Selection -->
                                        <div class="mb-4">
                                            <label class="form-label" for="role">Register As</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                                <select id="role" name="role"
                                                    class="form-select @error('role') is-invalid @enderror" required>
                                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                                        User</option>
                                                    <option value="cafe_owner"
                                                        {{ old('role') == 'cafe_owner' ? 'selected' : '' }}>Café Owner
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Terms and Conditions -->
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                id="terms" required />
                                            <label class="form-check-label" for="terms">
                                                I agree to all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>

                                        <!-- Register Button -->
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2">
                                    <div class="col-md-6 coffee-image"
                                        style="background-image: url('{{ asset('images/coffee.jpg') }}');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
