<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login Admin</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo3.png') }}" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- <link href="css/styles.css" rel="stylesheet" /> -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
  </head>
  <body>
    <!-- Navigation-->

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('user.dashboard')}}"
          ><img src="{{ asset('assets/logo3.png') }}" width="50" alt=""
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"
                >Beranda</a
              >
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('user.beritas.index', 'user.beritas.show') ? 'active' : '' }}" href="{{ route('user.beritas.index')}}">Berita</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('products.index', 'products.show') ? 'active' : '' }}"  href="{{route('products.index')}}">Produk</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ request()->routeIs('user.about') ? 'active' : '' }}" href="{{ route('user.about') }}">Tentang Kami</a>
            </li>
          </ul>



            <a href="{{ route('user.cart') }}"
              ><button class="btn btn-outline-dark" type="submit">
                <i class="bi-cart-fill"></i>
                <!-- Cart
              <span class="badge bg-dark text-white ms-1 rounded-pill">0</span> -->
              </button></a
            >
          @auth
          <a href="{{ route('dashboard') }}"
            ><button class="btn btn-outline-dark mx-2">
              <i class="bi bi-person-fill"></i>{{ Auth::user()->name }}</button
          ></a>
          @else
            <a href="{{ route('login') }}"
            ><button class="btn btn-outline-dark mx-2">
              <i class="bi bi-person-fill"></i></button
          ></a>
          @endauth

        </div>
      </div>
    </nav>
    <!-- Header-->
    <!-- <header class="bg-dark py-5 mt-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">Shop in style</h1>
          <p class="lead fw-normal text-white-50 mb-0">
            With this shop hompeage template
          </p>
        </div>
        <div class="row"></div>
      </div>
    </header> -->

    <!-- Section-->
<section>
    <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Login Admin</h2>
            <div class="card my-5">
    
                 <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
            @csrf
    
                <div class="text-center">
                  <img src="{{ asset('../assets/logo3.png') }}" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                    width="200px" alt="profile">
                </div>
    
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Masukan Email" name="email" :value="old('email')" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password" autocomplete="current-password" required>
                </div>
                <div class="text-center"><button type="submit" class="btn btn-dark px-5 mb-5">Login</button></div>

              </form>
            </div>
    
          </div>
        </div>
      </div>
</section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">
          Copyright &copy; Your Website 2023
        </p>
      </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
  </body>
</html>
