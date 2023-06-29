<?php if (isset($_SESSION['username'])): ?>
    <li class="nav-link px-2 text-white">Welcome, <?= $_SESSION['username'] ?>!</li>
<?php endif; ?>