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

<main class="mt-5 pt-4">
    <!-- filter container -->
    <div class="d-flex justify-content-end bg-light position-absolute px-md-4 pt-4" id="filter_main_div">
        <form method="get" action="{{ request()->path() }}" class="w-100">
            <i class="fa-solid fa-xmark"></i>
            <div id="filter_list">
                <ul class="p-0 text-center">
                    <li>Manufacturer</li>
                ```blade
                </ul>
            </div>
            <div id="filter_option_list" class="m-md-4">
                @if($filters['manufacturers'])
                    @foreach($filters['manufacturers'] as $manufacturer)
                        @if($manufacturer['manufacturer'] != '')
                            <div class="form-check my-2 mx-3">
                                <input class="form-check-input" type="checkbox" name="manufacturer" id="option_{{ $loop->index }}" value="{{ $manufacturer['manufacturer'] }}" />
                                <label class="form-check-label" for="option_{{ $loop->index }}">{{ $manufacturer['manufacturer'] }}</label>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="filter_list">
                <ul class="p-0 text-center">
                    <li>Category</li>
                </ul>
            </div>
            <div id="filter_option_list" class="m-md-4">
                @if($filters['categories'])
                    @foreach($filters['categories'] as $category)
                        @if($category['category'] != '')
                            <div class="form-check my-2 mx-3">
                                <input class="form-check-input" type="checkbox" name="category" id="category{{ $loop->index }}" value="{{ $category['id'] }}" />
                                <label class="form-check-label" for="category{{ $loop->index }}">{{ $category['name'] }}</label>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="filter_list">
                <ul class="p-0 text-center">
                    <li>Condition</li>
                </ul>
            </div>
            <div id="filter_option_list" class="m-md-4">
                @if($filters['conditions'])
                    @foreach($filters['conditions'] as $condition)
                        @if($condition['condition'] != '' && $condition['condition'] != null)
                            <div class="form-check my-2 mx-3">
                                <input class="form-check-input" type="checkbox" name="condition" id="condition{{ $loop->index }}" value="{{ $condition['condition'] }}" />
                                <label class="form-check-label" for="condition{{ $loop->index }}">{{ $condition['condition'] }}</label>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="filter_list">
                <ul class="p-0 text-center">
                    <li>Availability</li>
                </ul>
            </div>
            <div id="filter_option_list" class="m-md-4">
                @if($filters['availabilities'])
                    @foreach($filters['availabilities'] as $availability)
                        @if($availability['availability'] != '' && $availability['availability'] != null)
                            <div class="form-check my-2 mx-3">
                                <input class="form-check-input" type="checkbox" name="availability" id="availability_{{ $loop->index }}" value="{{ $availability['availability'] }}" />
                                <label class="form-check-label" for="availability_{{ $loop->index }}">{{ $availability['availability'] }}</label>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <button type="submit" class="btn text-white position-absolute" style="background-color: #090841; bottom: 13px; right: 40px;">Apply Filter</button>
        </form>
    </div>

    <a class="categorybtn d-sm-none mx-2 text-decoration-none">Categories <svg xmlns="http://www.w3.org/2000/svg"
            width="18" height="18" fill="currentColor" class="bi bi-sign-turn-right" viewBox="0 0 16 16">
            <path
                d="M5 8.5A2.5 2.5 0 0 1 7.5 6H9V4.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L9.41 8.658A.25.25 0 0 1 9 8.466V7H7.5A1.5 1.5 0 0 0 6 8.5V11H5z" />
            <path fill-rule="evenodd"
                d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58 ```blade
            .58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134Z" />
        </svg></a>
    <div id="categorybox"
        class="container-fluid mt-2 px-2 py-4 py-sm-0 h-10 d-flex flex-column-reverse flex-sm-row position-absolute align-items-center justify-content-start text-nowrap overflow-scroll"
        style="background-color: #070736; z-index: 20;">
        @if($filters['categories'])
        <span class="mx-3 no-link"><a href="{{ route('product-list-categorized', ['name' => 'all']) }}"> All Products </a></span>
        @foreach($filters['categories'] as $category)
            @if($category['category'] != '')
                <span class="mx-3 no-link"><a href="{{ route('product-list-categorized', ['name' => $category]) }}"> {{ $category }}</a></span>
            @endif
        @endforeach
        @else
            <span class="w-10 mx-2 no-link"> Sorry! No Categories Available Right Now...</span>
        @endif
    </div>

    <div class="container-fluid mt-3">
        <div class="row d-flex justify-content-center">
            <div class="d-flex justify-content-between">
                <p class="mt-sm-5 pt-sm-3">Showing products of {{ $name }} category. </p>
                <button class="btn border mt-sm-5 me-3 px-3" id="filter_btn"><i class="fa-solid fa-filter"></i> Filter Content</button>
            </div>

            <!-- Main Content -->
            <div class="row">
                @if($products)
                    <div class="product-grid">
                        @foreach($products as $product)
                            <div class="product-card">
                                <a href="{{ route('product-view', ['id' => $product->id]) }}" class="text-decoration-none border-none">
                                    <div class="card h-100" style="background-color: rgb(245, 245, 245);">
                                        <div class="card-img-top-wrapper p-3">
                                            <img src="{{ asset($product->image) }}" alt="Product Name" class="card-img-top rounded" style="mix-blend-mode: darken; aspect-ratio:calc(4/4)">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <span class="text-secondary" style="font-size: 14px; margin: -25px 0px 10px 0px;">{{ $product->category }}</span>
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
                                                @if($product->price)
                                                    <span class="text-secondary fw-bolder fs-4">${{ $product->price }} <span style="font-size: 14px;">{{ $product->currency }}</span></span>
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

                    @if($products->total() > 15)
                        <div class="pagination d-flex justify-content-center mt- ```blade
                        <div class="pagination d-flex justify-content-center mt-4">
                            <ul class="pagination">
                                @if($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">First</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->url(1) }}">First</a>
                                    </li>
                                @endif

                                @if($products->previousPageUrl())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                                    </li>
                                @endif

                                @foreach($products->getUrlRange(1, $products->lastPage()) as $num => $url)
                                    @if($num == $products->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $num }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $num }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if($products->nextPageUrl())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                    </li>
                                @endif

                                @if($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->url($products->lastPage()) }}">Last</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Last</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                @else
                    <div class="col-md-4">
                        <div class="fw-bolder" style="height: 50vh;"> Sorry! No Products Available.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    let categorybox = document.querySelector('#categorybox');
    let categorybtn = document.querySelector('.categorybtn');
    let a = 0;

    if (window.innerWidth <= 575) {
        categorybox.style.left = "-100vw";
        categorybox.style.transition = "0.3s";
        a = 1;

        categorybtn.addEventListener("click", () => {
            categorybox.style.width = "65%";

            if (a == 0) {
                categorybox.style.left = "-100vw";
                categorybox.style.transition = "0.3s";
                a = 1;
            } else {
                categorybox.style.left = "0vw";
                categorybox.style.transition = "0.3s";
                a = 0;
            }
        })
    } else {
        categorybox.style.left = "0vw";
        categorybox.style.transition = "0.3s";
        a = 0;
    }

    // filter option script
    let openfilter = document.querySelector('#filter_btn');
    let closefilter = document.querySelector('.fa-xmark');

    openfilter.addEventListener("click", () => {
        document.querySelector("#filter_main_div").style.right = "5px";
    })

    closefilter.addEventListener("click", () => {
        document.querySelector("#filter_main_div").style.right = "100%";
    })
</script>

@endsection