@extends('components.Layout')

@section('content')
<div class="container border-3">
    <div class="row mt-5 pt-3 mx-0 w-100 d-flex justify-content-center">
        <div class="p-2">
            <div class="col-sm-8 col-md-6 py-2 py-3 container-fluid border bg-light rounded px-md-5">
                <ul id="errmsg">
                </ul>
                <form id="registerform" action="{{ route('signup.post') }}" method="POST" class="" enctype="multipart/form-data"
                    onsubmit="return registercheck();">
                    <h2 class="text-center"><i class="fa-solid fa-user-plus"></i> Registration</h2>
                    
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button id="registerbtn" class="btn btn-primary container fw-bolder mb-2" type="submit">Register</button>
                    <p>Already Have An Account? <a href="{{ route('login') }}">LogIn Here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let form = document.querySelector('#registerform');
    let msg = document.querySelector('#errmsg');

    let registercheck = () => {
        let name = document.querySelector('#name').value;
        let password = document.querySelector('#password');
        let confirmpassword = document.querySelector('#password_confirmation').value;
        let email = document.querySelector('#email').value;

        // Updated password pattern to include period and better regex format
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;

        setTimeout(() => {
            msg.innerHTML = "";
        }, 5000);

        if (name.length < 3 || name.length > 255) {
            msg.innerHTML += `<li class="text-danger">Name must be between 3 and 255 characters!</li>`;
            return false;
        }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            msg.innerHTML += `<li class="text-danger">Please enter a valid email address!</li>`;
            return false;
        }

        // Updated password validation to use test() method
        if (!passwordPattern.test(password.value)) {
            msg.innerHTML += `<li class="text-danger">Must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 characters!</li>`;
            return false;
        }

        if (password.value !== confirmpassword) {
            msg.innerHTML += `<li class="text-danger">Passwords do not match!</li>`;
            return false;
        }

        return true;
    }
</script>
@endsection 