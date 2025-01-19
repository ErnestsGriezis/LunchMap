<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <h2>Reset Your Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div class="mb-4">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                autofocus />
            @error('email')
                <div class="text-danger">
                    <small><strong>{{ $message }}</strong></small>
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" required />
            @error('password')
                <div class="text-danger">
                    <small><strong>{{ $message }}</strong></small>
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                required />
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>


    </form>
</body>

</html>
