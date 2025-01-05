@extends('components.Layout')

@section('content')
<style>
    .sidebar {
        background-color: #f8f9fa;
        padding: 15px;
    }

    .product-image {
        height: 200px;
        object-fit: contain;
    }

    #categorybox::-webkit-scrollbar {
        display: none;
    }

    .price {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .original-price {
        text-decoration: line-through;
        color: #6c757d;
    }

    .discount {
        color: #28a745;
    }

    .badge-amazon-choice {
        background-color: #232f3e;
        color: white;
    }

    .badge-best-seller {
        background-color: #ff9900;
        color: white;
    }

    .badge-festival {
        background-color: #dc3545;
        color: white;
    }

    .categorybtn {
        color: #070736;
        border: 1px solid #070736;
        padding: 5px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }

    .product-card {
        background-color: rgb(245, 245, 245);
        height: 100%;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .product-image {
        height: 200px;
        object-fit: contain;
        mix-blend-mode: darken;
    }

    .category-nav {
        background-color: #070736;
        overflow-x: auto;
        white-space: nowrap;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .category-nav::-webkit-scrollbar {
        display: none;
    }

    .category-link {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        display: inline-block;
    }

    .category-link:hover, .category-link.active {
        background-color: rgba(255,255,255,0.1);
    }

    @media (max-width: 1200px) {
        .product-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 992px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }

    /* filter functionality css */
    #filter_main_div {
        z-index: 30;
        padding-bottom: 50px;
        right: 100%;
        width: 75%;
        height: fit-content;
        box-shadow: 1px 1px 5px grey;
    }

    #filter_list {
        margin: 15px;
        padding: 15px 0px 1px 0px;
        height: fit-content;
        background-color: #f0f0f0;
    }

    #filter_option_list {
        width: fit-content;
    }

    @media(max-width: 650px) {
        #filter_main_div {
            width: 100%;
        }

        #filter_list {
            width: 93%;
        }
    }

    #filter_list ul li {
        list-style-type: none;
        margin: 0px 5px;
        color: #070736;
        cursor: pointer;
    }

    #filter_option_list {
        height: fit-content;
        display: flex;
        flex-wrap: wrap;
    }

    .fa-xmark {
        top: 8px;
        right: 10px;
        font-size: 30px;
        position: absolute;
    }

    #filter_btn {
        height: fit-content;
        letter-spacing: 0.5px;
    }
</style>

<main class="container-fluid mt-5 pt-4">
    <!-- Category Navigation -->
    <div class="category-nav mb-4">
        <div class="container">
            <a href="{{ route('product-list-categorized', ['name' => 'all']) }}?{{ http_build_query(request()->except(['page', 'category'])) }}" 
                class="category-link {{ $name === 'all' ? 'active' : '' }}">
                All Products
            </a>
            @foreach($filters['categories'] as $category)
                <a href="{{ route('product-list-categorized', ['name' => $category->name]) }}?{{ http_build_query(request()->except(['page', 'category'])) }}" 
                    class="category-link {{ $name === $category->name ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="container-fluid mt-3">
        <!-- Header -->
        <div class="row d-flex justify-content-center">
            <div class="d-flex justify-content-between">
                <p class="mt-sm-5 pt-sm-3">Showing products of {{ $name }} category.</p>
                <button class="btn border mt-sm-5 me-3 px-3" id="filter_btn">
                    <i class="fa-solid fa-filter"></i> Filter Content
                </button>
            </div>
        </div>
    
        <!-- Main Content -->
        <div class="row">
            @if($products->count() > 0)
                <div class="product-grid">
                    @foreach($products as $product)
                        <div class="product-card">
                            <a href="{{ route('product-view', $product->id) }}" class="text-decoration-none border-none">
                                <div class="card h-100" style="background-color: rgb(245, 245, 245);">
                                    <div class="card-img-top-wrapper p-3">
                                        <img src="{{ asset($product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="card-img-top rounded" 
                                             style="mix-blend-mode: darken; aspect-ratio:calc(4/4)">
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <span class="text-secondary" style="font-size: 14px; margin: -25px 0px 10px 0px;">
                                            {{ $product->category->name }}
                                        </span>
                                        <h5 class="card-title fw-bolder text-dark">{{ $product->name }}</h5>
                                        <p class="card-text flex-grow-1 text-secondary">{{ $product->description }}</p>
                                        <table class="table" style="font-size: 12px; margin-top: -20px;">
                                            <tbody>
                                                @if($product->part_number)
                                                    <tr>
                                                        <td class="fw-bold">Part Number</td>
                                                        <td>{{ $product->part_number }}</td>
                                                    </tr>
                                                @endif
                                                @if($product->availability)
                                                    <tr>
                                                        <td class="fw-bold">Availability</td>
                                                        <td>{{ $product->availability }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-between">
                                            @if($product->adjusted_price)
                                                <span class="text-secondary fw-bolder fs-4">
                                                    ${{ number_format($product->adjusted_price, 2) }} 
                                                    <span style="font-size: 14px;">{{ session('currency', 'CAD') }}</span>
                                                </span>
                                            @else
                                                <span class="text-danger fw-bolder fs-5">Login to view price</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
    
                @if($products->count() > 15)
                    <!-- Pagination -->
                    <div class="pagination d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <div class="col-md-4">
                    <div class="fw-bolder" style="height: 50vh;">
                        Sorry! No Products Available.
                    </div>
                </div>
            @endif
        </div>
    </div>
    

    <!-- Filter Sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Filter Products</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form method="get" action="{{ route('product-list-categorized', ['name' => 'all']) }}">
                <!-- Manufacturer Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Manufacturer</h6>
                    @foreach($filters['manufacturers'] as $manufacturer)
                        @if($manufacturer->manufacturer)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="manufacturer[]" 
                                    value="{{ $manufacturer->manufacturer }}"
                                    {{ in_array($manufacturer->manufacturer, (array)request('manufacturer')) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $manufacturer->manufacturer }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Category Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Category</h6>
                    @foreach($filters['categories'] as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                name="category[]" 
                                value="{{ $category->id }}"
                                {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Apply Filters
                </button>
            </form>
        </div>
    </div>
</main>

<script>
    // Initialize Bootstrap's offcanvas
    document.getElementById('filter_btn').addEventListener('click', function() {
        var offcanvas = new bootstrap.Offcanvas(document.getElementById('filterSidebar'));
        offcanvas.show();
    });
</script>
@endsection