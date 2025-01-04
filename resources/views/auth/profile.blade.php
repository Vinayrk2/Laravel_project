@extends('components.Layout')

@section('content')
<style>
    .container {
        margin-top: 12vh;
    }
</style>

<main class="form-signin d-flex w-100 mb-4 text-center justify-content-center container">
    <div class="card mx-1 overflow-hidden" style="width: 50rem; background-color: rgb(250, 250, 250);">
        <div class="px-3">
            <div class="rounded-2 pt-3 justify-content-center">
                <!-- Profile image section commented out as in original -->
                <!-- <div>
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" alt="sfds" style="border-radius: 100%; max-width: 40%; max-height: 20%; object-fit: cover;">
                </div> -->
                <h3>Profile</h3>
            </div>

            <div class="form-floating">
                <input disabled type="text" class="form-control rounded mt-3" id="floatingname" 
                    value="{{ $user->name }}" required>
                <label for="floatingname">Name</label>
            </div>

            <div class="form-floating">
                <input disabled type="email" class="form-control rounded mt-3" id="floatingemail" 
                    value="{{ $user->email }}" required>
                <label for="floatingemail">Email</label>
            </div>

            <div class="form-floating">
                <input disabled type="text" class="form-control rounded mt-3" id="floatingdate" 
                    value="{{ $user->created_at->format('Y-m-d') }}" required>
                <label for="floatingdate">Date of Join</label>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4 mb-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger mt-4 mb-4 text-decoration-none fs-5 w-100">Logout</button>
            </form>
        </div>
    </div>
</main>
@endsection 