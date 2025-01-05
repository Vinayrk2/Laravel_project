<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Success' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        main {
            width: 95vw;
        }
    </style>
</head>
<body>
    <main class="d-flex justify-content-center align-items-center mx-3 my-5 m-md-5">
        <div class="bg-light p-3 p-sm-5">
            <div class="d-flex">
                <img src="{{ asset('storage/'.'success.png') }}" style="mix-blend-mode: darken; width: 35px; height: 35px;">&nbsp;
                <h3>{{ $title }}</h3>
            </div>
            <p class="lead mt-4">{{ $message }}</p>
            <div>
                <a href="{{ route('index') }}" id="homebtn" class="btn border m-2 py-2 px-4 text-white" style="background-color: #090841; letter-spacing: 0.5px;">
                    {{ $buttonText ?? 'Go To Homepage' }}
                </a>
                <a href="{{ route('contactpage') }}" class="btn m-2 py-2 px-4" style="border: 1px solid #090841;">Contact Us</a>
            </div>
            <p class="mt-3">You will be redirected to homepage in <span id="second" class="text-danger fw-bold fs-5 border">10</span> seconds</p>
        </div>
    </main>

    <script>
        let second = document.querySelector('#second');
        let homebtn = document.querySelector('#homebtn');
        let secondcount = 10;
        setInterval(() => {
            if (secondcount <= 0) {
                homebtn.click();
            } else {
                secondcount--;
                second.innerHTML = secondcount;
            }
        }, 1000);
    </script>
</body>
</html>
