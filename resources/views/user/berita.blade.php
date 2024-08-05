@extends('user.main_master')
@section('content')
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-2">
        <h1 class="text-center mb-5">Berita</h1>
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
                <a href="{{ route('user.beritas.show', $berita->slug) }}" class="btn btn-primary">Read More</a>
              </div>
            </div>
          </div>
        @endforeach
        @endif
        </div>
      </div>
    </section>
@endsection
