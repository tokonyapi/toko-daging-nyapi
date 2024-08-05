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
