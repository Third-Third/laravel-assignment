@extends('layouts.frontend')
<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Quicksand&display=swap" rel="stylesheet">

@section('content')
<div class="container py-5 px-4 rounded-4" style="background-color: #7a848fff;">
    <!-- Header Section -->
    <div class="d-flex align-items-center justify-content-center mb-5 py-4 px-3 rounded-4"
        style="background: linear-gradient(135deg, #bec5efff, #f1f3f5); box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #dee2e6;">

        <!-- Logo -->
        <div class="me-3">
            <img src="{{ asset('img/npit.png') }}" alt="NPIT Logo" style="height: 150px; width: auto;">
        </div>

        <!-- Title and Tagline -->
        <div class="text-center">
            <h1 class="fw-bold mb-2" style="font-size: 2.75rem; font-family: 'Poppins', sans-serif; color: #0d6efd;">
                <span style="color: #0077b6; font-family: AKbalthom Superhero;">RITHY 
                    <span style="font-family: Cooper Black">FOOD COURT</span>
                </span>
            </h1>
            <p class="text-secondary" style="font-size: 1.1rem; font-family: 'Quicksand', sans-serif;">
                <em>Explore our refreshing drinks and delightful desserts</em>
            </p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="container mb-4">
        <form id="searchForm"
            action="{{ request()->routeIs('items.search') && request('query') ? route('items.index') : route('items.search') }}"
            method="GET"
            class="d-flex justify-content-center">
            <input type="text" name="query" id="queryInput"
                value="{{ request()->routeIs('items.search') ? request('query') : '' }}"
                class="form-control me-2" style="max-width: 70%;" placeholder="Search items...">

            @if(request()->routeIs('items.search') && request('query'))
            <button type="submit" id="searchButton" class="btn btn-light text-dark">Back</button>
            @else
            <button type="submit" id="searchButton" class="btn btn-light text-dark">Search</button>
            @endif
        </form>
    </div>

    <!-- Search Term Heading -->
    @if(request()->routeIs('items.search') && request('query'))
    <div class="text-center mb-4">
        <h5 class="text-light">Search results for: <strong><i>{{ request('query') }}</i></strong></h5>
    </div>
    @endif

    <!-- Item Grid -->
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($items as $item)
        <div class="col">
            <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden d-flex flex-column">

                <!-- Image Section -->
                <div class="card-img-top d-flex justify-content-center align-items-center"
                    style="height: 220px; background-color: #e9ecef;">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->name_en }}"
                        style="max-width: 150px; max-height: 150px; object-fit: contain;">
                    @else
                    <img src="{{ asset('img/default.png') }}"
                        alt="No Image"
                        style="width: 100%; height: 100%; opacity: 0.6;">
                    @endif
                </div>

                <!-- Text Section -->
                <div class="card-body text-start" style="flex-shrink: 0;">
                    <div class="fw-bold fs-5">{{ $item->name_en }}</div>
                    <div class="text-muted">{{ $item->name_kh }}</div>
                    <div class="mt-2 text-success fw-semibold fs-5">
                        ${{ number_format($item->price, 2) }}
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="d-flex justify-content-center align-items-center text-light" style="height: 300px; width: 100%;">
            <em class="fs-5 mb-0 text-center w-100">No items found.</em>
        </div>
        @endforelse

    </div>
</div>

<!-- JavaScript for dynamic button swap -->
<script>
    const input = document.getElementById('queryInput');
    const button = document.getElementById('searchButton');
    const form = document.getElementById('searchForm');
    input.addEventListener('focus', () => {
        button.textContent = 'Search';
        button.classList.remove('btn-outline-light');
        button.classList.add('btn-primary');
        form.action = "{{ route('items.search') }}";
    });
</script>

@if(request()->routeIs('items.search'))
<script>
    if (window.performance && window.performance.getEntriesByType("navigation")[0].type === "reload") {
        window.location.href = "http://127.0.0.1:8000/items";
    }
</script>
@endif


@endsection