@extends('components.Layout')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100vh;
    }

    .container {
        height: auto;
        width: auto;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        margin-top: 10vh;
        font-size: 1.5rem;
    }

    #img-div {
        height: 60vh;
        width: 100%;
        background-image: url({{ asset('storage/'.$service->image) }});
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    @media (max-width:770px) {
        #img-div {
            height: 40vh;
            width: 100%;
            background-size: contain;
            background-image: url({{ asset('storage/'.$service->image) }});
            background-position: center;
            margin: 0 auto;
        }
    }

    @media (max-width:360px) {
        #img-div {
            height: 30vh;
            width: 100%;
            background-size: contain;
            background-image: url({{ asset('storage/'.$service->image) }});
            background-position: center;
            margin: 0 auto;
        }
    }

    #description {
        font-size: 1.1rem;
        text-align: justify;
    }

    .service-name {
        color: #065baa;
        font-size: 2rem;
    }

    .service-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-header {
        grid-column: 1 / -1;
        background-color: #f2f2f2;
        font-size: 1.5rem;
        font-weight: bold;
        padding: 1rem;
        text-align: center;
    }

    .service-item {
        border: 1px solid rgb(230, 230, 230);
    }

    .item-label {
        background-color: #f8f9fa;
        font-weight: bold;
        padding: 0.75rem;
        font-size: 20px;
    }

    .item-content {
        padding: 0.75rem;
        word-wrap: break-word;
        font-size: 15px;
    }

    .nested-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
    }

    .nested-label {
        font-weight: bold;
        padding: 10px;
        border-bottom: 1px solid rgb(228, 228, 228);
    }

    .nested-value {
        word-wrap: break-word;
        text-align: justify;
        padding: 10px;
        border-bottom: 1px solid rgb(228, 228, 228);
    }

    .status-available {
        font-size: 22px;
        color: green;
        letter-spacing: 0.5px;
    }

    .status-unavailable {
        font-size: 22px;
        color: red;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .service-item {
            grid-template-columns: 1fr;
        }

        .item-label {
            border-right: none;
 border-bottom: 1px solid #ddd;
        }

        .nested-grid {
            grid-template-columns: 1fr;
        }

        .nested-label {
            background-color: #f8f9fa;
            padding: 0.25rem 0px;
            border: none;
        }

        .nested-value {
            border: none;
        }
    }

    @media (max-width: 576px) {
        body {
            font-size: 14px;
        }

        .service-header {
            font-size: 1.2rem;
        }

        .item-label, .item-content {
            padding: 0.5rem;
        }
    }
</style>

<div class="container">
    <div class="">
        <div class="row">
            <p class="service-name mt-3 fw-bold">
                {{ $service->name }}
            </p>
        </div>
        <div class="row">
            <p id="description">{{ $service->description }}</p>
        </div>

        <div class="row img-fluid" id="img-div">
        </div>
    </div>

    <div class="container-fluid mt-4"></div>
    <div class="service-grid">
        <div class="service-header" id="title">Service Information</div>
        
        @if(is_array($service->specifications))
        <div class="service-item">
            <div class="item-label">Specifications</div>
            <div class="item-content">
                <div class="nested-grid">
                    @foreach($service->specifications as $key => $value)
                    <div class="nested-label">{{ $key }}</div>
                    <div class="nested-value">{{ $value }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="service-item">
            <div class="item-label">Service Status</div>
            <div class="item-content">
                @if($service->status)
                <span class="status-available">Available</span>
                @else
                <span class="status-unavailable">Not Available</span>
                @endif
            </div>
        </div>

        <div class="service-item">
            <div class="item-label">Service Type</div>
            <div class="item-content">{{ $service->service_type }}</div>
        </div>

        @if(is_array($service->technical_information))
        <div class="service-item">
            <div class="item-label">Technical Information</div>
            <div class="item-content">
                <div class="nested-grid">
                    @foreach($service->technical_information as $key => $value)
                    <div class="nested-label">{{ $key }}</div>
                    <div class="nested-value">{{ $value }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection