@extends('components.Layout')

@section('content')
<style>
    .img_container::-webkit-scrollbar {
        display: none;
    }

    #main-img {
        animation-name: wipe-cinematic-in;
        animation-duration: 0.1s;
        animation-timing-function: cubic-bezier(.25, 1, .30, 1);
    }

    @keyframes wipe-cinematic-in {
        from {
            clip-path: inset(0 100% 0 0);
        }
        to {
            clip-path: inset(0 0 0 0);
        }
    }
</style>

<div class="container" style="margin-top: 80px;">
    <main class="container-fluid my-5 border p-4 p-sm-5 rounded">
        <div class="row">
            <div class="col-md-6 pe-3">
                <div class="d-flex justify-content-between" style="margin-top: 37.5%; mix-blend-mode: darken;">
                    <i class="fa-solid fa-chevron-left fs-2 bg-light text-dark py-2 px-3" onclick="slideImage(-1)"></i>
                    <i class="fa-solid fa-chevron-right fs-2 bg-light text-dark py-2 px-3" onclick="slideImage(1)"></i>
                </div>
                <div>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" id="main-img"
                        style="margin-top: -45%; height:80%; aspect-ratio:calc(16/14)">
                </div>

                <div class="img_container" style="display: flex; flex-wrap: nowrap; overflow-x: scroll;">
                    @foreach($product->images as $image)
                    <div class="box rounded me-2 mt-3"
                        style="height:70px; width: 70px; aspect-ratio: calc(4/4); background-color: rgb(238, 238, 238); cursor: pointer;">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="" class="zoom" style="mix-blend-mode: darken;">
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="col-md-6 p-3 p-sm-5 mt-3 mt-md-0 rounded-2"
                style="background-color: rgb(241, 241, 241); height: 100%;">
                <h3 class="mb-3 fw-bold">{{ $product->name }}</h3>
                <p class="lead fs-6 text-secondary">{{ $product->description }}</p>
                <p>{{ $product->category->name }}</p>

                <table class="table" style="font-size: 12px;">
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
                        @if($product->manufacturer)
                        <tr>
                            <td class="fw-bold">Manufacturer</td>
                            <td>{{ $product->manufacturer }}</td>
                        </tr>
                        @endif
                        @if($product->condition)
                        <tr>
                            <td class="fw-bold">Condition</td>
                            <td>{{ $product->condition }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                @if($product->adjusted_price)
                    <span class="text-secondary fw-bolder fs-4">${{ $product->adjusted_price }} 
                        <span style="font-size: 14px;">{{ session('currency','CAD') }}</span>
                    </span>
                @else
                    <span class="text-danger fw-bolder fs-5">Login to view price</span>
                @endif

                <div class="d-flex align-items-center flex-wrap">
                    <!-- <a href=""> -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn mt-2 me-2 py-2 px-4 text-white" style="background-color: #090841;">+ Add to Cart</button>
                    </form>
                    <!-- </a> -->
                    @if($product->more_details)
                        <a href="{{ $product->more_details }}" target="_blank">
                            <button class="btn mt-2 me-2 py-2 px-4" style="border: 1px solid #090841;">
                                More Details
                            </button>
                        </a>
                    @else
                        <button class="btn me-2 mt-2 py-2 px-4" type="button" 
                            style="border: 1px solid #090841;"
                            onclick="showAlert('No details available')">
                            More Details
                        </button>
                    @endif
                </div>
            </div>

            @if($product->features)
            <div class="container mt-5">
                <h2 class="mb-4">Product Features</h2>
                <div class="table-responsive" style="margin: 0px -20px;">
                    <table class="table feature_table table-bordered table-striped">
                        <tbody>
                            @foreach($product->features as $key => $value)
                            <tr>
                                <td class="fw-bold">{{ $key }}</td>
                                <td style="text-align: justify;">{{ $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </main>
</div>

<div class="container" style="margin-bottom: 10vh;">
    <h2 class="mb-3">Related Items</h2>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        @foreach($related_products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="{{ route('product-view', $product->id) }}" class="text-decoration-none mt-3">
                <div class="card bg-light h-100">
                    <img src="{{ $product->image }}" class="card-img-top p-4 rounded-2" 
                        alt="{{ $product->name }}" style="mix-blend-mode: darken; aspect-ratio:calc(4/4);">
                    <div class="card-body" style="margin-bottom: -10px;">
                        <span class="text-secondary" style="font-size: 14px; margin: -25px 0px 10px 0px;">
                            {{ $product->category->name }}
                        </span>
                        <h5 class="card-title text-decoration-none text-dark fw-bold">{{ $product->name }}</h5>
                        @if($product->manufacturer)
                            <p class="text-decoration-none text-dark">Manufacturer: {{ $product->manufacturer }}</p>
                        @endif
                        <div class="d-flex justify-content-between">
                            @if($product->adjusted_price)
                                <span class="text-secondary fw-bolder fs-4">${{ $product->adjusted_price }}
                                    <span style="font-size: 14px;">{{ session('currency','CAD') }}</span>
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
</div>

<script>
    let zoom = document.getElementsByClassName('zoom');
    let img = document.getElementById('main-img');
    let current = 0;

    for (let i = 0; i < zoom.length; i++) {
        zoom[i].addEventListener('click', (e) => {
            img.style.animation = "none";
            setTimeout(() => {
                img.src = e.target.src;
                img.style.animation = "wipe-cinematic-in 0.1s 1";
            }, 50);
        });
    }

    const slideImage = (change) => {
        if(zoom.length == 1) {
            return;
        }
        
        switch(change) {
            case -1:
                if (current == 0)
                    current = zoom.length;
                current = (current-1) % zoom.length;
                break;
            
            case 1:
                if (current == 3)
                    current = -1;
                current = (current+1) % zoom.length;
                break;
        }
        
        img.style.animation = "none";
        setTimeout(() => {
            img.src = zoom[current].src;
            img.style.animation = "wipe-cinematic-in 0.1s 1";
        }, 50);
    }

    const showAlert = (a) => alert(a);
</script>
@endsection 