@extends('user.main_master')
@section('content')

<header>
        <div class="mt-5">
      <div
        id="carouselExampleInterval"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img
              height="500"
              src="https://www.constructionplusasia.com/wp-content/uploads/2023/01/3-2.jpg"
              class="d-block w-100 object-fit-cover"
              alt="..."
            />
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img
              height="500"
              src="https://surinusantarajaya.com/cfind/source/thumb/images/news/image-detail/cover_w969_h399_news-11-harga-kebutuhan-pokok.jpg"
              class="d-block w-100 object-fit-cover"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              height="500"
              src="https://mmc.tirto.id/image/2020/03/16/ilustrasi-daging-di-supermarket-istock--3.jpg"
              class="d-block w-100 object-fit-cover"
              alt="..."
            />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleInterval"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleInterval"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
</header>
<section class="pt-5">
      <div class="container px-4 px-lg-5 mt-5">
                  
        <div class="card-button justify-content-between d-flex">
          <h1 class="mb-5">Produk</h1>
          <div>
            <button class="btn btn-dark"><a href="{{ route('products.index') }}" class="text-white text-decoration-none">View All</a></button>
          </div>
        </div>
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
        @if($products->isEmpty())
                    <p class="text-center">Produk tidak tersedia.</p>
                @else
        @foreach($products as $product)
          <div class="col mb-5">

            <div class="card h-100">
              <!-- Product image-->
              <a href="{{ route('products.show', $product->slug) }}"
                ><img
                  src="{{ asset('img-product/' . $product->image) }}"
                  height="250" width="auto" class="card-img-top object-fit-cover" alt="{{ $product->slug }}"
              /></a>
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">{{ $product->name }}</h5>
                  <!-- Product price-->
                  Rp. {{ number_format($product->price, 0, ',', '.') }}
                </div>
              </div>
              <!-- Product actions-->
              <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <form method="POST" action="{{ route('user.addtocart', $product->id ) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark w-100">Add to Cart</button>
                    </form>
                </div>
              </div>
            </div>

          </div>
          @endforeach
      @endif

      </div>
    </section>

    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-2">
        <div class="card-button justify-content-between d-flex">
          <h1 class="mb-5">Berita</h1>
          <div>
            <button class="btn btn-dark"><a href="{{ route('user.beritas.index') }}" class="text-white text-decoration-none">View All</a></button>
          </div>
        </div>
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
                @if($beritas->isEmpty())
                    <p class="text-center">Berita tidak tersedia.</p>
                @else
        @foreach ($beritas as $berita)
          <div class="col mb-5">
            <div class="card">
              @if ($berita->image)
                        <a href="{{ route('user.beritas.show', $berita->slug) }}"><img src="{{ asset('img-berita/' . $berita->image) }}" height="250" width="auto" class="card-img-top object-fit-cover" alt="{{ $berita->title }}"></a>
                    @endif
              <div class="card-body">
                <h5 class="card-title">{{ $berita->title }}</h5>
                <p class="card-text">
                  {{ \Illuminate\Support\Str::limit($berita->deskripsi, 100) }}
                </p>
                <a href="{{ route('user.beritas.show', $berita->slug) }}" class="btn btn-outline-dark w-100">Read More</a>
              </div>
            </div>
          </div>
        @endforeach
        @endif
        </div>
      </div>
    </section>

@endsection
