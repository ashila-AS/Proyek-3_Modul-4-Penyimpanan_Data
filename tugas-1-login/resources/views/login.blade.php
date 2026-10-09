<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
    <h1>Login</h1>
    <p>Masuk untuk membuka dashboard</p>

    @error('login')
        <p style="color:red">{{ $message }}</p>
    @enderror

    <form method="POST" action="/login">
        @csrf
        <p>Username<br>
            <input type="text" name="username" value="{{ old('username') }}" required></p>
        <p>Password<br>
            <input type="password" name="password" required></p>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>