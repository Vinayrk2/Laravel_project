@extends('components.Layout')

@section('content')
<style>
    .container {
        margin: 10vh auto;       
    }

    .card {
        max-width: 500px;
        width: 100%;
        margin: 5vh auto;
    }

    .btn-check:checked+.btn-outline-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    body, html {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    #mainbox {
        flex: 1;
    }

    .form-label {
        margin-bottom: 0px;
    }
</style>

<main id="mainbox">
    <div class="container pt-1 mt-5">
        <div class="card shadow-sm bg-light">
            <div class="card-body">
                <form action="{{ route('contactpage') }}" method="post" onsubmit="return validate()">
                    @csrf
                    <h2 class="text-center">Contact Us</h2>
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                        <span id="nameAlert"></span>
                    </div>
                    @auth
                        <input type="hidden" class="form-control" name="username" value="{{ Auth::user()->username }}" disabled placeholder="auto name" required>
                    @endauth
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        @auth
                            <input type="email" class="form-control" name="email" id="emailAddress" value="{{ Auth::user()->email }}" disabled placeholder="you@example.com" required>
                        @else
                            <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
                        @endauth
                    </div>
                    <div class="mb-3">
                        <label for="customTopic" class="form-label">Description</label>
                        <textarea class="form-control" id="customTopic" rows="5" name="description" placeholder="Detailed description" required></textarea>
                        <span id="contactAlert"></span>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn text-white col col-4 mx-1" style="background-color: #090841;">Submit</button>
                        <button type="reset" class="btn col col-4 mx-1" style="border: 1px solid #090841;">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function validate() {
        let description = document.getElementById("customTopic").value;

        if (description.length < 10) {
            document.getElementById('contactAlert').innerText = "Description is too short. Please enter at least 10 characters.";
            return false;
        } else {
            return showLoading();
        }
    }
</script>
@endsection