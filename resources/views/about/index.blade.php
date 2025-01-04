<style>
    body,
    html {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    #mainbox {
        flex: 1;
    }

    .container {
        margin-top: 10vh;
        border-radius: 1vh;
        width: fit-content;
    }

    .card-text {
        text-align: justify;
    }

    #company_name {
        transform: rotate(165deg);
        left: 15%;
        bottom: 50px;
        font-weight: bolder;
        pointer-events: none;
        letter-spacing: 1px;
        font-size: 190px;
        color: rgba(6, 9, 187, 0.103);
    }

    .container {
        position: relative;
        display: inline-block;
        margin-bottom: -40px;
    }

    .background-image {
        position: absolute;
        top: -90px;
        padding-bottom: -50px;
        left: 0;
        width: 100%;
        height: 120%;
        z-index: -1;
        object-fit: cover;
        opacity: 0.4;
    }

    #backh5 {
        position: relative;
        padding: 30px;
        -webkit-text-stroke: 2px rgb(255, 255, 255);
        text-align: center;
    }

    @media(max-width: 700px) {
        #company_name {
            font-size: 100px;
        }

        .container {
            margin-bottom: -100px;
        }

        .background-image {
            top: -140px;
        }

        #backh5 {
            top: -40px;
            padding: 55px;
            -webkit-text-stroke: 1px rgb(255, 255, 255);
        }
    }

    /* divider */
    .custom-shape-divider-bottom-1731775089 {
        margin-top: -50px;
        width: 100%;
        line-height: 0;
        transform: rotate(180deg);
    }

    .custom-shape-divider-bottom-1731775089 svg {
        position: relative;
        display: block;
        width: calc(170% + 1.3px);
        height: 167px;
    }

    .custom-shape-divider-bottom-1731775089 .shape-fill {
        fill: #f3f3f3a2;
    }
</style>

@extends('components.Layout')

@section('content')
<main id="mainbox">
    <div class="container-fluid p-0 mt-5">
        <section class="container-fluid">
            <div class="text-center py-5">
                <div class="container">
                    <img src="{{ asset('storage/'.'about background.png') }}" alt="Background Image" class="background-image">
                    <h5 id="backh5" class="display-2 fw-lighter mb-4 fw-bold">ABOUT US</h5>
                </div>
                <p class="lead px-md-5 text-secondary">
                    {{ $content['main_description'] }}
                </p>
            </div>
        </section>

        <section class="row bg-0 m-0">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-3-dark rounded">
                    <div class="card-body rounded">
                        <h2 class="card-title text-center mb-4 fs-2 fw-bold">{{ $content['field1'] }} <i class="fa-solid fa-crosshairs text-primary fs-3"></i></h2>
                        <p class="card-text">
                            {{ $content['field1_Description'] }}
 </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-3-dark rounded">
                    <div class="card-body rounded">
                        <h2 class="card-title text-center mb-4 fs-2 fw-bold">{{ $content['field2'] }} <i class="fa-solid fa-eye text-danger fs-3"></i></h2>
                        <p class="card-text">
                            {{ $content['field2_Description'] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-3-dark rounded bg-transperent">
                    <div class="card-body rounded">
                        <h2 class="card-title text-center mb-4 fs-2 fw-bold">{{ $content['field3'] }} <i class="fa-solid fa-hand-holding-hand text-success fs-3"></i></h2>
                        <p class="card-text">
                            {{ $content['field3_Description'] }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="custom-shape-divider-bottom-1731775089">
            <h1 class="position-absolute" id="company_name">QF Avionics</h1>
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
        <div class="bg-light p-2 p-md-5">
            @if($sections)
            @foreach($sections as $section)
            <section class="bg-white p-4 rounded my-3 m-0">
                <h2 class="h3 mb-4 text-center fw-bolder">{{ $section['title'] }}</h2>
                <div class="row">
                    @if(isset($section['column']))
                    @foreach($section['column'] as $title => $info)
                    <div class="col-md-6 mb-3">
                        <h4 class="h5 fw-bold">{{ $title }}</h4>
                        <p class="card-text mb-3">{{ $info }}</p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </section>
            @endforeach
            @endif
        </div>
    </div>
</main>
@endsection