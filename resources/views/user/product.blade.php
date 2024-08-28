@extends('user.main_master')
@section('content')

<header>
               
<section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <h1 class="text-center mb-5">Produk</h1>
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
                  alt="{{ $product->image }}"
                  height="250" width="auto" class="card-img-top object-fit-cover"
              /></a>
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">{{ $product->name }}</h5>
                  <!-- Product price-->
                  <p>Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
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
      </div>
    </section>

@endsection
