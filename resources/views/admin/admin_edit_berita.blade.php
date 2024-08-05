@extends('admin.admin_master')
@section('content')

<div class="container m-2">


        <h2>Edit Berita</h2>
        <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $berita->title }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required>{{ $berita->deskripsi }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ $berita->slug }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Berita</button>
        </form>
    </div>
    @endsection

</div>

@endsection
