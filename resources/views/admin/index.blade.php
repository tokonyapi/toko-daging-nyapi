@extends('admin.admin_master')
@section('content')

<div class="container m-2">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <h2 class="mb-5">Product List</h2>
    @foreach($categories as $category)
        <h3 class="text-center my-4">{{ ucfirst($category) }}</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">image</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products->where('category', $category) as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td ><a href="{{ $product->slug }}" class="text-decoration-none text-black">{{ $product->name }}</a></td>
                    <td>
                        <img src="{{ asset('img-product/' . $product->image) }}" width="100">
                    </td>
                    <td class="text-end">{{ $product->stock }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.delete_product', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <h2 class="mb-4">Berita List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Deskripsi</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beritas as $berita)
                <tr>
                    <td>{{ $berita->id }}</td>
                    <td>{{ $berita->title }}</td>
                    <td>{{ $berita->deskripsi }}</td>
                    <td>
                            <img src="{{ asset('img-berita/' . $berita->image) }}" width="100">
                    </td>
                    <td>
                        <a href="{{ route('admin.beritas.edit', $berita->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.beritas.destroy', $berita->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
