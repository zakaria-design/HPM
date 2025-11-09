<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    /* Body dan background gradasi */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #1e3a8a 0%, #000000 35%, #ff7f50 70%, #000000 100%);
    }

    /* Card login */
    .login-card {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    .login-card h1 {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    /* Form elements */
    .login-card label {
        display: block;
        margin-bottom: 0.3rem;
        font-weight: bold;
    }

    .login-card input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #ccc;
        box-sizing: border-box;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    /* Border oranye saat diketik */
    .login-card input:focus {
        outline: none;
        border-color: #ff7f50; /* oranye */
        box-shadow: 0 0 5px rgba(255,127,80,0.5);
    }

    /* Tombol oranye */
    .login-card button {
        width: 100%;
        padding: 0.6rem;
        background-color: #ff7f50; /* oranye */
        color: white;
        border: none;
        border-radius: 0.25rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .login-card button:hover {
        background-color: #e6733f; /* lebih gelap sedikit saat hover */
    }

    /* Error messages */
    .alert {
        background-color: #f8d7da;
        color: #842029;
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .login-card {
            padding: 1.5rem;
        }

        .login-card input, .login-card button {
            font-size: 0.95rem;
        }
    }
</style>
</head>
<body>

<div class="login-card">
    <h1>Login</h1>

    {{-- memanggil pesan eror di controller --}}
    @if($errors->any())
        <div class="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>     
                @endforeach
            </ul>
        </div>
    @endif

    <form action="" method="POST">
        @csrf
        <label for="user_id">User ID</label>
        <input type="text" name="user_id" value="{{ old('user_id') }}">

        <label for="password">Password</label>
        <input type="password" name="password">

        <button type="submit" name="submit">Login</button>
    </form>
</div>

</body>
</html>
