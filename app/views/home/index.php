<?php require_once('/app/sessionstart.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <title>Art webshop</title>
  <link rel="stylesheet" href="css/navbarstyle/style.css">
  <link rel="stylesheet" href="css/home/style.css">
</head>

<body class="text-center">
  <header class="p-3 text-bg-dark sticky-top">
    <div class="container">
      <div class="d-flex sticky-top flex-wrap align-items-center justify-content-center justify-content-lg-start">

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <?php require('/app/sessionuser.php') ?>
          <li><a href="/" class="nav-link px-2 text-warning">Home</a></li>
          <li><a href="/buysell" class="nav-link px-2 text-white">Buy/Sell</a></li>
          <li><a href="/collection" class="nav-link px-2 text-white">Collection</a></li>
        </ul>

        <div class="text-end">
          <?php if (isset($_SESSION['username'])): ?>
            <a href="/logout" class="btn btn-outline-primary text-white">Logout</a>
          <?php else: ?>
            <a href="/login" class="btn btn-outline-primary text-white">Login</a>
            <a href="/signup" class="btn btn-outline-primary text-white">Sign-up</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
  <section class="frontpage">
    <div class="px-4 py-5 my-5 text-center text-white">
      <h1 class="display-5 fw-bold">The Art Webshop</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Welcome to our bidding site for original artwork! Here, you'll find a diverse collection of
          pieces from talented artists around the world. Whether you're looking for a unique painting, sculpture, or
          photograph, you're sure to find something that speaks to you. We have a wide variety of styles and mediums to
          choose from, so you're sure to find something that fits your taste. Start browsing now and find the perfect
          addition that you can bid on against people around the world!</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <?php if (isset($_SESSION['username'])): ?>
            <a href="/logout" class="btn btn-primary btn-lg px-4 gap-3 mx-3">Logout</a>
          <?php else: ?>
            <a href="/login" class="btn btn-primary btn-lg px-4 gap-3 mx-3">Login</a>
            <a href="/signup" class="btn btn-primary btn-lg px-4 gap-3 mx-3">Sign-up</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>