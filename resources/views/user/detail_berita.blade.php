@extends('user.main_master')
@section('content')

<section class="py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
                @if ($berita->image)
        <img src="{{ asset('img-berita/' . $berita->image) }}" width="500">
                @endif
        </div>
          <div class="col-md-6">
            <h1 class="display-5 fw-bolder">{{ $berita->title }}</h1>
            <p class="lead">
              {{ $berita->deskripsi }}
            </p>
            <div class="d-flex">
                <a href="{{ route('user.beritas.index') }}" class="btn btn-primary mt-3">Back to Berita List</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
