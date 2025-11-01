@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0" style="font-family: AKbalthom Superhero;">Category List</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Add New Item</a>

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>SKU</th>
                        <th>Barcode</th>
                        <th style="width: 15%;">Name EN</th>
                        <th style="width: 15%;">Name KH</th>
                        <th style="width: 10%;">Price</th>
                        <th style="width: 15%;">Image</th>
                        <th style="width: 50%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->sku }}</td>
                        <td>{{ $category->barcode }}</td>
                        <td>{{ $category->name_en }}</td>
                        <td>{{ $category->name_kh }}</td>
                        <td>${{ number_format($category->price, 2) }}</td>

                        <!-- Image -->
                        <td class="text-center align-middle">
                            @php
                            $imagePath = public_path('storage/' . $category->image);
                            @endphp

                            @if($category->image && file_exists($imagePath))
                            <img src="{{ asset('storage/' . $category->image) }}" width="60" height="60" style="object-fit: cover; border-radius: 6px;">
                            @else
                            <span><i>No Image</i></span>
                            @endif
                        </td>


                        <td class="text-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm px-3 py-2 me-1">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm px-3 py-2 me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3 py-2">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<script>
    if (performance.navigation.type === 1) {
        window.location.href = "{{ route('dashboard') }}";
    }
</script>
