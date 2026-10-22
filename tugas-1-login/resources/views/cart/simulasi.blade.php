<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Simulasi Cart</title>
</head>
<body>
    <h1>Simulasi Cart</h1>
    <p>Login sebagai: {{ auth()->user()->username }} ({{ auth()->user()->role }})</p>

    <form method="POST" action="{{ route('cart.add') }}">
        @csrf
        <input type="hidden" name="cart[0][product_id]" value="1">
        <input type="hidden" name="cart[0][qty]" value="2">
        <button type="submit">POST /cart/add</button>
    </form>
</body>
</html>