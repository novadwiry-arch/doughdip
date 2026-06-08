<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Dough & Dip</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#fff3f8;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 0 15px rgba(0,0,0,0.1);
            width:350px;
        }

        h2{
            text-align:center;
            color:#d63384;
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ddd;
            border-radius:10px;
        }

        button{
            width:100%;
            padding:10px;
            background:#d63384;
            color:white;
            border:none;
            border-radius:10px;
            cursor:pointer;
        }

        .error{
            color:red;
            text-align:center;
            margin-bottom:10px;
        }

        .btn-close-login{
            position:fixed;

            top:20px;
            left:20px;

            width:45px;
            height:45px;

            display:flex;
            justify-content:center;
            align-items:center;

            background:white;

            color:#ff4b91;

            text-decoration:none;

            border-radius:50%;

            font-size:24px;
            font-weight:bold;

            box-shadow:0 5px 15px rgba(0,0,0,0.15);

            transition:0.3s;
        }

        .btn-close-login:hover{
            background:#ff4b91;
            color:white;

            transform:scale(1.1);
        }
    </style>
</head>
<body>

<a href="/" class="btn-close-login">
    ✕
</a>

<div class="login-box">

    <h2>Dough & Dip Admin</h2>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/admin/login">

        @csrf

        <input
            type="text"
            name="username"
            placeholder="Username"
            required>

        <input
            type="password"
            name="password"
            placeholder="Password"
            required>

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>