<?php require_once('/app/sessionstart.php') ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Registration</title>
    <link rel="stylesheet" href="css/loginstyle/style.css">
    <link rel="stylesheet" href="css/navbarstyle/style.css">
    <link rel="stylesheet" href="css/mainstyle/style.css">
</head>

<body class="text-center">
    <header class="p-3 text-bg-dark sticky-top">
        <div class="container">
            <div class="d-flex sticky-top flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <?php require('/app/sessionuser.php') ?>
                    <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="/buysell" class="nav-link px-2 text-white">Buy/Sell</a></li>
                    <li><a href="/collection" class="nav-link px-2 text-white">Collection</a></li>
                </ul>

                <div class="text-end">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="/logout" class="btn btn-outline-primary text-white">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="btn btn-outline-primary text-white">Login</a>
                        <a href="/signup" class="btn btn-outline-primary text-warning">Sign-up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="container login-form-container">
        <main class="form-signin w-50 m-auto">
            <form action="/signup" method="post">
                <h1 class="h3 mb-3 fw-normal text-white">Please sign up</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password">
                    <label for="password">Password</label>
                </div>
                <input class="w-100 btn btn-lg btn-primary signup-button" type="submit" value="Sign-up">
            </form>
        </main>
    </div>
</body>

</html>