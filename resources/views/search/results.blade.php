@extends('components.Layout')

@section('content')
<style>
    .scroll-item {
        width: 360px;
        height: 230px;
        overflow: hidden;
        background-size: cover;
        border-radius: 20px;
        box-shadow: 0.5px 0.5px 5px 0.5px gray;
        background-position: center;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }

    .product-card {
        background-color: rgb(245, 245, 245);
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
</style>

<div class="container-fluid mt-5 pt-4">
    <!-- Filter Sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Filter Results</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <form method="get" action="{{ route('search') }}">
                <input type="hidden" name="q" value="{{ $query }}">

                <!-- Manufacturer Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Manufacturer</h6>
                    @foreach($filters['manufacturers'] as $manufacturer)
                        @if($manufacturer->manufacturer)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="manufacturer[]" 
                                    value="{{ $manufacturer->manufacturer }}"
                                    {{ in_array($manufacturer->manufacturer, (array)request('manufacturer', [])) ? 'checked' : '' }}>
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
                                {{ in_array($category->id, (array)request('category', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Condition Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Condition</h6>
                    @foreach($filters['conditions'] as $condition)
                        @if($condition->condition)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="condition[]" 
                                    value="{{ $condition->condition }}"
                                    {{ in_array($condition->condition, (array)request('condition')) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $condition->condition }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Availability Filter -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Availability</h6>
                    @foreach($filters['availabilities'] as $availability)
                        @if($availability->availability)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="availability[]" 
                                    value="{{ $availability->availability }}"
                                    {{ in_array($availability->availability, (array)request('availability')) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $availability->availability }}
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>

                <button type="submit" class="btn w-100 text-white" style="background-color: #090841;">
                    Apply Filters
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11 mx-auto">
            @if($news->count() > 0 || $products->count() > 0)
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>Showing results for "{{ $query }}"</div>
                    <button class="btn btn-outline-primary" id="filter_btn">
                        <i class="fa-solid fa-filter"></i> Filter Results
                    </button>
                </div>
            @endif

            @if($news->count() > 0)
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">News</h4>
                        <div>({{ $news->count() }} news found)</div>
                    </div>

                    <div class="scroll-container d-flex overflow-auto">
                        @foreach($news as $item)
                            <div class="scroll-item m-2">
                                <a href="{{ $item->url }}" class="text-decoration-none">
                                    <div class="position-relative h-100" 
                                        style="background-image: url('{{ asset('storage/'.$item->image) }}'); 
                                               background-size: cover; 
                                               background-position: center;">
                                        <div class="position-absolute bottom-0 w-100 p-3 text-white" 
                                            style="background: rgba(0,0,0,0.7);">
                                            <h5 class="mb-0">{{ $item->title }}</h5>
                                            <small>{{ $item->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr class="my-4">
            @endif

            @if($products->count() > 0)
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Products</h4>
                        <div>({{ $productsCount }} products found)</div>
                    </div>

                    <div class="product-grid">
                        @foreach($products as $product)
                            <div class="product-card">
                                <a href="{{ route('product-view', $product->id) }}" class="text-decoration-none">
                                    <div class="card h-100">
                                        <img src="{{ $product->image }}" class="card-img-top p-3" 
                                            alt="{{ $product->name }}" style="mix-blend-mode: darken;">
                                        <div class="card-body">
                                            <span class="text-secondary small">{{ $product->category->name }}</span>
                                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                            @if($product->manufacturer)
                                                <p class="card-text">Manufacturer: {{ $product->manufacturer }}</p>
                                            @endif
                                            @if($product->price)
                                                <span class="text-secondary fw-bold fs-4">${{ $product->adjusted_price }}
                                                    <span class="small">{{ session('currency','CAD') }}</span>
                                                </span>
                                            @else
                                                <span class="text-danger fw-bold">Login to view price</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

            @if($news->count() === 0 && $products->count() === 0)
                <div class="text-center py-5">
                    <h3>No results found for "{{ $query }}"</h3>
                    <p>Try different keywords or check your spelling</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.getElementById('filter_btn').addEventListener('click', function() {
    var offcanvas = new bootstrap.Offcanvas(document.getElementById('filterSidebar'));
    offcanvas.show();
});
</script>
@endsection 