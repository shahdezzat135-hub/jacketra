<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Jacketra</title>
</head>
<style>
    html {
    scroll-behavior: smooth;
}

    .carousel-item img{
        height: 550px;
    }
</style>
<body>
<nav class="navbar navbar-expand-lg mb-3 shadow-sm " data-bs-theme="btn-dark">
<div class="container">
<div class="d-flex justify-content-start align-items-center gap-2">
    <img
        src="images/(10).jpg"
        alt="Jacketra logo"
        class="rounded-circle"
        style="width: 30px; height: 30px; object-fit: cover;"
    >

    <a class="navbar-brand fw-bold text-secondary" href="#">Jacketra</a>

</div>

<button class="navbar-toggler" type="button"
data-bs-toggle="collapse"
data-bs-target="#mainNav">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="mainNav">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" role="button" href="#Categories" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
  <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Categories </button> -->
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Men's jackets</a></li>
    <li><a class="dropdown-item" href="#">Women's jackets</a></li>
    <li><a class="dropdown-item" href="#">UniSex's jackets</a></li>
  </ul>
</li>
<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
<li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
<li class="nav-item">
    <a class="btn btn-outline-secondary"
       href="#cartShow"
       data-bs-toggle="offcanvas">

        Cart

        <span id="cartBadge"
              class="badge bg-secondary">
            0
        </span>

    </a>
</li>
</ul>
</div> 

</div>
</nav>


<main class="container-fluid ">