<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QF Avionics</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/main.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Play:wght@400;700&display=swap');
    </style>
</head>

<body>
    <main id="mainbox">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-sm-flex" style="cursor: pointer; color: rgb(160, 160, 160);">
                    <div class="me-3" id="dialButton">
                        <i class="fas fa-phone"></i> {{ $globalOptions['header']['phone_number'] ?? '+1 (403) 886-4306' }}
                    </div>
                    <div class="me-3" id="emailButton">
                        <i class="fas fa-envelope"></i> {{ $globalOptions['header']['email'] ?? 'info@qfavionics.com' }}
                    </div>
                </div>
                <h3 id="companyname" style="letter-spacing: 1px;">QF Avionics</h3>
                <div class="d-sm-flex">
                    <div class="d-flex justify-content-center align-items-center" style="margin-top: -6px;">
                        <a href="{{ $globalOptions['footer']['instagram'] ?? '#' }}" class="text-white mt-2 me-2"><i
                                class="fa-brands fa-instagram fs-6"></i></a>
                        <a href="{{ $globalOptions['footer']['youtube'] ?? '#' }}" class="text-white mt-2 me-2"><i
                                class="fa-brands fa-youtube fs-6"></i></a>
                        <a href="{{ $globalOptions['footer']['linkedin'] ?? '#' }}" class="text-white mt-2 me-2"><i
                                class="fa-brands fa-linkedin fs-6"></i></a>
                    </div>
                    <select class="form-select" id="currency-value" aria-label="Default select example"
                        style="height: 35px; width: 105px;">
                        @if (session('currency') == 'USD')
                            <option value="USD" selected>💲USD</option>
                            <option value="CAD">💲CAD</option>
                        @else
                            <option value="USD">💲USD</option>
                            <option value="CAD" selected>💲CAD</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="position-absolute navbar navbar-expand-lg navbar-light bg-white w-100" style="z-index: 200;">
            <div class="container-fluid border-bottom">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage/'.'logo.png') }}" alt="QF Avionics"
                        style="max-width: min(50px,50px); max-height: min(10vh,10vw);">
                </a>
                <a class="navbar-toggler" style="border: none; margin-right: -10px;" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <img src="{{ asset('images/toggle.png') }}">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link md:mt-3" href="{{ route('index') }}"><i class="fa-solid fa-house"></i> HOME</a>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link"><i class="fa-solid fa-layer-group"></i> SERVICES</a>
                            <ul id="dropdown">
                                @foreach ($globalOptions['services'] as $service)
                                    <a href="{{ route('service', ['id' => $service->id]) }}" class="text-decoration-none text-dark">
                                        <li>{{ $service->name }}</li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link"><i class="fa-solid fa-store"></i> SHOP</a>
                            <ul id="dropdown">
                                <a href="{{ route('product-list-categorized', ['name' => 'all']) }}"
                                    style="text-decoration:none; color:black;">
                                    <li> All Products </li>
                                </a>
                                @foreach ($globalOptions['categories'] as $category)
                                    <a href="{{ route('product-list-categorized', ['name' => $category]) }}"
                                        style="text-decoration:none; color:black;">
                                        <li>{{ $category }}</li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link" href="{{ route('view-news') }}"><i class="fa-solid fa-newspaper"></i> NEWS</a>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link" href="{{ route('gallery_list') }}"><i class="fa-solid fa-image"></i> GALLERY </a>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link" href="{{ route('aboutpage') }}"><i class="fa-solid fa-address-card"></i> ABOUT</a>
                        </li>
                        <li class="nav-item" id="menu">
                            <a class="nav-link" href="{{ route('contactpage') }}"><i class="fa-solid fa-address-book"></i> CONTACT</a>
                        </li>
                    </ul>
                    <div class="icon-container d-flex mx-2 mt-2 mt-md-0 mb-3 mb-md-0">
                        @auth
                            <a href="{{ route('profile') }}"
                                class="text-dark me-3 text-decoration-none border px-3 py-1 rounded">
                                <i class="fas fa-user fs-6"></i> {{ Auth::user()->username }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-dark me-3 fs-6">
                                <i class="fas fa-user fs-6"></i>
                            </a>
                        @endauth
                        <div>
                            <a href="{{ route('cart.index') }}" class="text-dark me-3">
                                <span class="position-absolute bg-dark text-white fw-bold px-1"
                                    style="font-size: 10px; border-radius: 100%; margin-top: -5px; margin-left: 8px; z-index: 2;">
                                    {{ $no_of_items ?? 0 }}
                                </span>
                                <i class="fas fa-shopping-cart fs-6"></i>
                            </a>
                        </div>
                        <a id="searchopen" class="text-dark"><i class="fas fa-search fs-6"></i></a>
                    </div>
                    
                </div>
            </div>
        </nav>

        <!-- Messages -->
        @if (session('messages'))
            <ul class="messages" style="margin-top: 12vh; position: absolute; z-index: 1000; right: 15px;">
                @foreach (session('messages') as $message)
                    <div class="alert alert-{{ $message['type'] }}" role="alert">
                        {{ $message['text'] }}
                    </div>
                @endforeach
            </ul>
        @endif

        <!-- Main Content -->
        @yield('content')
    </main>

    <footer class="footer mt-4">
        <div class="container-fluid">
            <div class="row">
                <!-- Services Section -->
                <div class="col-md-3">
                    <h5><i class="fa-solid fa-layer-group fs-6"></i> Services</h5>
                    <ul>
                        @if($globalOptions['services'] )
                            @foreach($globalOptions['services']->slice(0, 6) as $service)
                                <a href="{{ route('service', ['id' => $service->id]) }}" class="text-decoration-none text-secondary">
                                    <li id="hover_white">{{ $service->name }}</li>
                                </a>
                            @endforeach
                        @endif
                    </ul>
                </div>
    
                <!-- Important Links Section -->
                <div class="col-md-3">
                    <h5><i class="fa-solid fa-link fs-6"></i> Important Links</h5>
                    <ul class="text-secondary">
                        @if($globalOptions['links'])
                            @foreach($globalOptions['links']->slice(0,6) as $link)
                                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none text-secondary">
                                    <li id="hover_white">{{ $link->name }}</li>
                                </a>
                            @endforeach
                        @endif
                    </ul>
                </div>
    
                <!-- Location Section -->
                <div class="col-md-3">
                    <h5><i class="fa-solid fa-location-dot fs-6"></i> Location</h5>
                    <div class="text-secondary">
                        <a href="https://www.google.com/maps/dir//3801+Airport+Dr,+Springbrook,+AB+T4S+2E8/@52.1763421,-113.9696467,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x537450468fc942f9:0xb14e4971aebfab17!2m2!1d-113.8872465!2d52.1763708?entry=ttu&g_ep=EgoyMDI0MTAyMy4wIKXMDSoASAFQAw%3D%3D"
                           class="text-decoration-none text-secondary" target="_blank">
                            <pre id="hover_white" style="font-size: 1rem; font-family: Play, sans-serif;">
                                {{ $globalOptions['footer']['location'] ?? 
'
QF Avionics Center Ltd
Hangar #11 Airport Drive,
Springbook, 
ABT4S 2E8 Canada'}}
                            </pre>
                        </a>
                    </div>
                </div>
    
                <!-- Social Media Section -->
                <div class="col-md-3">
                    <h5><i class="fa-solid fa-hashtag"></i> Social Media Channel</h5>
                    <p class="text-secondary">Follow to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
                    <a href="{{ $footer['instagram'] ?? '#' }}" class="text-secondary mt-2 me-2">
                        <i id="hover_white" class="fa-brands fa-instagram mx-1 fs-4"></i>
                    </a>
                    <a href="{{ $footer['youtube'] ?? '#' }}" class="text-secondary mt-2 me-2">
                        <i id="hover_white" class="fa-brands fa-youtube mx-1 fs-4"></i>
                    </a>
                    <a href="{{ $footer['linkedin'] ?? '#' }}" class="text-secondary mt-2 me-2">
                        <i id="hover_white" class="fa-brands fa-linkedin mx-1 fs-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Loading Animation -->
    <div class="load" id="loading">
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240" style="display:inherit;">
            <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20"
                    stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20"
                    stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20"
                    stroke-dasharray="0 440" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20"
                    stroke-dasharray="0 440" stroke-linecap="round"></circle>
        </svg>
    </div>
    

    <script>
                let searchcancel = document.querySelector('#searchcancel');
        let searchopen = document.querySelector('#searchopen');
        let searchmsg = document.querySelector('#searchmsg');

        // search input validation
        let searchfunc = () => {
            let searchinput = document.querySelector('#searchinput').value;

            setTimeout(() => {
                searchmsg.innerText = "";
            }, 5000);

            if (searchinput.length < 3) {
                searchmsg.innerText = "search text length must be greater then 3 characters!";
                return false;
            } else {
                searchmsg.innerText = "";
            }
            return true;
        }

        // search functionallity
        searchopen.addEventListener("click", () => {
            searchbox.style.left = "0vh";
            searchbox.style.width = "100%";
            searchbox.style.display = "block";
            searchbox.style.transition = "0.3s";
        })

        searchcancel.addEventListener("click", () => {
            searchbox.style.left = "-150%";
            searchbox.style.display = "none";
            searchbox.style.transition = "0.3s";
        })

        document.querySelector("#currency-value").addEventListener('change', (e) => {
            let selected = e.target.value;

            setCurrency(selected);
        })

        function setCurrency(currency) {
            console.log(currency)
            fetch("/set_currency/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ "currency": currency })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload()
                    } else {
                        alert("Failed to set currency: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Error setting currency:", error);
                    alert("An error occurred while setting the currency.");
                });
        }

        window.addEventListener('load', () => {
            document.querySelectorAll(".alert").forEach((value, key) => {
                setTimeout(() => {
                    value.style.opacity = 0
                }, 2000 * (key + 1))
            })
        })

        // Email functionality
        document.getElementById("emailButton").addEventListener("click", function () {
            const email = '{{ $header->email ?? "info@qfavionics.com"}}';
            const subject = "Contact To Distributor";
            const body = "type your message here";

            const mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

            window.location.href = mailtoLink;
        });

        // phone number functionality
        document.getElementById("dialButton").addEventListener("click", function () {
            const phoneNumber = '{{$header->phone_number ?? "403 886 4306"}}';
            window.location.href = `tel:${phoneNumber}`;
        });

        // loading functionality
        const showLoading = (e) => {
            document.getElementById("loading").style.display = "flex";
            document.querySelector("body").style.overflow = "hidden";
            return true;
        }
    </script>
    @stack('scripts')
</body>

</html>
