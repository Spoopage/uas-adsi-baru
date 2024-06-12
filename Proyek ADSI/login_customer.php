<?php

include './includes/connection.php';
// session_start();

if (isset($_POST['login_customer'])) {
    // $id = $_POST['id_pelanggan'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_customer = "SELECT id_pelanggan, password FROM pelanggan WHERE nama_pelanggan = ?";
    $check_customer = $conn->prepare($check_customer);
    $check_customer->execute([$username]);
    $fetch_pelanggan = $check_customer->fetch();

    if ($check_customer->rowCount() == 0)
        $msg = 'Username tidak terdaftar!';
    else if (!password_verify($password, $fetch_pelanggan['password'])) {
        $msg = 'Password yang Anda ketik salah!';
    } else {
        $_SESSION['login_customer'] = $fetch_pelanggan['id_pelanggan'];
        header('location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer</title>

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Inline styling -->
    <style>
        .login-form {
            max-width: 500px;
            border: 1px solid #ddd;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            /* border-radius: 5%; */
            background-color: white;
        }

        .login-form .title {
            background: #222;
            color: #fff;
            padding: 15px 10px;
            text-align: center;
            font-size: 25px;
            border-radius: 8px;
        }

        .login-form .content {
            padding: 15px;
        }

        .bg_img {
            background-image: url(https://c4.wallpaperflare.com/wallpaper/849/138/463/nature-high-resolution-wallpaper-preview.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="bg_img"></div>
    
    <div class="login-form">
        <div class="title">
            WELCOME DEAR CUSTOMER
        </div>
        <div class="content">

            <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>

            <form method="post">
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Masukkan Username">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password">
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-dark mt-1" type="submit" name="login_customer">Login</button>
                </div>
                <br>
                <div class="d-grid gap-2 mb-1">
                    <a class="btn btn-dark" href="index.php">Back To Store</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>