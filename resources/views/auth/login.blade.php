@extends('components.Layout')

@section('content')
<style>
    /* Keeping the media query commented as in original */
    /* @media (min-width:550px) {
       .container{
         width:90vw;
       } 
       button{
        width:80vw;
       }
    } */
</style>

<div class="row mx-0 w-100 d-flex justify-content-center" style="margin-top: 10vh;">
    <div class="p-2">
        <div class="col-sm-8 col-md-6 py-2 py-3 container-fluid border bg-light rounded px-md-5">
            <p id="errmsg" class="text-danger"></p>
            <form id="loginform" action="{{ route('login.post') }}" method="POST" onsubmit="return logincheck();">
                <h2 class="text-center"><i class="fa-solid fa-user-large"></i> Login</h2>
                
                @csrf
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

                <div class="mb-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                        Forgot Your Password?
                    </a>
                </div>

                <button class="btn btn-primary container my-2" type="submit">Login</button>
                <p>Create a new account? <a href="{{ route('signup') }}">Register Now</a></p>
            </form>
        </div>
    </div>
</div>

<script>
    let form = document.querySelector('#loginform');
    let msg = document.querySelector('#errmsg');

    let logincheck = () => {
        let email = document.querySelector('#email').value;
        let password = document.querySelector('#password');
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/;

        setTimeout(() => {
            msg.innerText = "";
        }, 5000);

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            msg.innerText = "Please enter a valid email address!";
            return false;
        }

        // Password validation using test() method
        if (!passwordPattern.test(password.value)) {
            msg.innerText = "Must contain at least one number, one uppercase letter, one lowercase letter, one special character, and at least 8 characters!";
            return false;
        }

        return true;
    }
</script>
@endsection 