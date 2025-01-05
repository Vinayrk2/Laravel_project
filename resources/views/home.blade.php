@extends('components.Layout')

@section('content')
<style>
    .scroll-container {
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
    }

    .scroll-item {
        min-width: 300px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        margin-right: 10px;
        border-radius: 10px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
    }

    .product-card {
        background-color: rgb(245, 245, 245);
        margin-bottom: 20px;
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

    .scroll-container {
    overflow-x: auto; /* Enable horizontal scrolling */
    overflow-y: hidden; /* Hide vertical scrolling */
    white-space: nowrap; /* Prevent wrapping of content */
    display: flex;
    padding-bottom: 1rem;
    /* gap: 1rem; Add space between items */
    scrollbar-width: thin; /* Thin scrollbar for Firefox */
    scrollbar-color: #888 #f1f1f1; /* Scrollbar thumb and track colors for Firefox */
}
    .scroll-container::-webkit-scrollbar {
    height: 6px; /* Adjust the scrollbar height */
    
}

.scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1; /* Track background color */
    border-radius: 10px; /* Optional: rounded corners */
}


.scroll-container::-webkit-scrollbar-thumb {
    background: #888; /* Scrollbar thumb color */
    border-radius: 10px; /* Optional: rounded corners */
}

.scroll-container::-webkit-scrollbar-thumb:hover {
    background: #555; /* Thumb color on hover */
}
</style>

<div class="container-fluid mt-5 pt-3">
    <div id="carouselExample" class="carousel slide" style="box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;">
        <div class="carousel-inner" style="height:max(35vh,35vw)">
            @if ($images)
                @foreach ($images as $image)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100" alt="..."
                            style="object-fit:cover; height:inherit;">
                    </div>
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div>
    <div class="container-fluid mt-5">
        <div class="row mb-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis" style="letter-spacing: 1px;"> WHAT WE DO</h1>
            <p class="lead px-3 text-secondary">
                QF Avionics, established in 1979, is a premier independent provider of aviation maintenance, repair, and overhaul (MRO) services in Canada. With over 40 years of experience, the company has built a strong reputation for delivering top-tier solutions across all aviation sectors, including commercial, military, and general aviation. QF Avionics sets the standard for reliability and innovation, ensuring aircraft remain in peak operational condition.
            </p>
        </div>
    </div>

    <div class="container my-5">
        <div class="row gx-5 gy-4 d-flex justify-content-center" >
            @if ($whatWeDo)
                @foreach ($whatWeDo as $section)
                    <div class="col-md-4" >
                        <div class="card rounded-0"
                            style="box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em; overflow: hidden;">
                            <div class="row no-gutters" style="height:100%;">
                                <div class="col-12" style="height: 25vh;">
                                    <img src="{{ asset('storage/' . $section->image) }}" alt="Online Store" class="card-img"
                                        style="height: 100%; object-fit: cover;">
                                </div>
                                <div class="col-12">
                                    <div class="card-body d-flex flex-column justify-content-center">
                                        <h2 class="card-title fs-3 fw-bold"
                                            style="height: 70px; width: 110%; margin: -85px 0px 0px -16px; background-color: rgba(3, 7, 44, 0.726); padding-left: 10px; color: rgb(223, 223, 223);">
                                            {{ $section->title }}</h2>
                                        <p class="card-text" style="height: 130px">{{ $section->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container-fluid p-2 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis" style="letter-spacing: 1px;">Our Product Categories</h1>
        <p class="lead px-3 mb-5 text-secondary">
            Explore an exceptional range of aviation products meticulously crafted for precision, reliability, and innovation. From cutting-edge avionics systems and advanced maintenance tools to everyday essentials, our categories are designed to meet the diverse needs of aviation professionals and enthusiasts alike. Whether you're enhancing performance or seeking seamless solutions, you'll find products tailored to elevate your experience in the skies and beyond.
        </p>
        <div class="scroll-container">
            @if ($categories)
                @foreach ($categories->slice(0,12) as $category)
                    <a href="{{ route('product-list-categorized', ['name' => $category->name]) }}" class="text-decoration-none">
                        <div class="scroll-item item1"
                            style="overflow: hidden; background-image: url('{{ asset('storage/' . $category->image) }}')">
                            <p class="fs-2 fw-bold rounded w-100 d-flex justify-content-center align-items-center text-white"
                                style="background-color: rgba(0, 0, 0, 0.6); height: 110%;">{{ $category->name }}</p>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="text-center text-muted">No categories available at the moment. Check back soon!</p>
            @endif
        </div>
    </div>
    

    <div class="container-fluid mt-5 ">
        <h1 class="display-5 fw-bold text-body-emphasis text-center" style="letter-spacing: 1px;">Featured Collection</h1>
        <p class="lead px-3 mb-5 text-secondary text-center">
            Dive into our exclusive selection of featured products, handpicked to represent the pinnacle of quality and innovation in aviation solutions. Each product in this collection is thoughtfully curated to ensure optimal performance, durability, and functionality. Whether you're upgrading equipment, exploring new technologies, or discovering unique tools, our featured collection embodies excellence that keeps you soaring.
        </p>
        <div class="product-grid">
            @if ($products)
                @foreach ($products as $product)
                    <div class="product-card">
                        <a href="{{ route('product-view', ['id' => $product['id']]) }}" class="text-decoration-none border-none">
                            <div class="card h-100" style="background-color: rgb(245, 245, 245);">
                                <div class="card-img-top-wrapper p-3">
                                    <img src="{{ $product['image'] }}" alt="Product Name" class="card-img-top rounded"
                                        style="mix-blend-mode: darken; aspect-ratio:calc(4/4)">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bolder text-dark">{{ $product['name'] }}</h5>
                                    <p class="card-text flex-grow-1 text-secondary">{{ $product['description'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($product['price'])
                                            <span class="text-secondary fw-bolder fs-4">${{ $product['price'] }} <span
                                                style="font-size: 14px;">{{ $product['currency'] }}</span></span>
                                        @else
                                            <span class="text-danger fw-bolder">Login to view price</span>
                                        @endif
                                        <span class="text-secondary" style="font-size: 13px;">{{ $product['category'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @guest
        <section class="px-4 text-center">
            <h1 class="display-6 fw-bold text-body-emphasis">SIGNUP OR LOGIN</h1>
            <div class="col-lg-6 mx-auto mt-4">
                <p class="lead mb-4 text-secondary">Login to the system to access the features and to get the latest updates on our products and services.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('signup') }}" class="btn rounded-sm" style="border: 1px solid rgb(202, 202, 202); border-radius: 50px; padding: 15px 25px;">
                        CREATE YOUR ACCOUNT
                    </a>
                    <a href="{{ route('login') }}" class="btn fw-bold" style="padding: 15px 25px;"> SIGN-IN </a>
                </div>
            </div>
        </section>
    @endguest
@endsection
