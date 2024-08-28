@extends('user.main_master')

@section('content')

    <section class="py-5 vh-100">
      <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img width="500" height="500" src="{{ asset('img-product/' . $product->image) }}" class="card-img-top mb-5 mb-md-0 object-fit-cover" alt="{{ $product->name }}">
        </div>
          <div class="col-md-6">
            <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
            <div class="fs-5 mb-5">
              <span>Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
              <p>Berat : {{ number_format($product->berat, 0, ',', '.') }} g</p>
              <p>Stock: {{ $product->stock }}</p>
            </div>
            <p class="lead">
              {{ $product->description }}
            </p>
            <div class="d-flex">
            <form method="POST" action="{{ route('user.addtocart', $product->id ) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
