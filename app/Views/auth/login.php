<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Arsip IA / SK</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f6;
            color: #1e293b;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 410px;
            background: #ffffff;
            border-radius: 8px;
            padding: 38px;
            box-shadow: 0 4px 18px rgba(0,0,0,.10);
        }

        .logo {
            width: 48px;
            height: 48px;
            background: #174f7d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 22px;
        }

        h1 {
            margin: 0 0 8px;
            color: #173f63;
            font-size: 25px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #174f7d;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #174f7d;
            color: white;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #123f63;
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 18px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-box">

        <div class="logo">▤</div>

        <h1>Arsip IA / SK</h1>

        <div class="subtitle">
            Document Management System
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">

            <label>Username</label>
            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                required
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">
                Masuk
            </button>

        </form>

    </div>

</div>

</body>
</html>