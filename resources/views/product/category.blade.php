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

    <div class="container">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Showing products of {{ $name }} category</h4>
            </div>
            <div class="col-md-6 text-md-end">
                <button class="btn btn-outline-primary" id="filter_btn">
                    <i class="fa-solid fa-filter"></i> Filter Products
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <a href="{{ route('product-view', $product->id) }}" class="text-decoration-none">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <img src="{{ asset($product->image) }}" 
                                            class="product-image w-100 mb-3" 
                                            alt="{{ $product->name }}">
                                        <h5 class="card-title text-dark">{{ $product->name }}</h5>
                                        <p class="card-text text-muted">{{ $product->category->name }}</p>
                                        
                                        @if($product->part_number)
                                            <p class="card-text small mb-1">
                                                Part Number: {{ $product->part_number }}
                                            </p>
                                        @endif
                                        
                                        @if($product->availability)
                                            <p class="card-text small mb-2">
                                                Availability: {{ $product->availability }}
                                            </p>
                                        @endif
                                        
                                        @if($product->price)
                                            <p class="price mb-0">
                                                ${{ number_format($product->price, 2) }}
                                                <small class="text-muted">{{ $product->currency }}</small>
                                            </p>
                                        @else
                                            <p class="text-danger">Login to view price</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4 class="alert-heading">No Products Found</h4>
                        <p>Sorry, no products are available in this category at the moment.</p>
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