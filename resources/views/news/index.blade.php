@extends('components.Layout')

@section('content')
<style>
    .news-item {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .news-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .news-content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .news-title {
        color: #0056b3;
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .news-date {
        color: #dc3545;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .learn-more {
        color: #6c757d;
        text-decoration: none;
        margin-top: auto;
    }

    .learn-more:hover {
        text-decoration: underline;
        color: #6c757d;
    }

    .description {
        flex-grow: 1;
    }
</style>

<div class="container mt-4 mb-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">

        @if($notifications->count() > 0)

        @foreach($notifications as $notification)

        <div class="col">
            <a href="{{ $notification->url }}" class="text-decoration-none text-dark" target="_blank">

                <div class="news-item">
                    <img src="{{ asset('storage/'.$notification->image) }}" alt="Aircraft" style="aspect-ratio: calc(16/9)">

                    <div class="news-content p-4">

                        <h2 class="news-title">{{ $notification->title }}</h2>

                        <p class="description">
                            {{ $notification->description }}
                        </p>

                        <p class="news-date">
                            {{ $notification->created_at->format('M. d, Y. h:i A') }}
                        </p>

                    </div>

                </div>
            </a>

        </div>
        @endforeach

        @if($notifications->total() > 12)
        <div class="pagination d-flex justify-content-center mt-4">
            {{ $notifications->links() }}
        </div>
        @endif

        @else
        <p>No notifications.</p>

        @endif
    </div>
</div>

<script>
    let description = document.getElementsByClassName('description');
    console.log(description);

    for (let i = 0; i < description.length; i++) {
        if (description[i].innerText.length > 95) {
            description[i].innerText = description[i].innerText.slice(0, 95);
            console.log(description[i]);
        }
    }

    let title = document.getElementsByClassName('news-title');
    for (let i = 0; i < title.length; i++) {
        if (title[i].innerText.length > 30) {
            title[i].innerText = title[i].innerText.slice(0, 30);
            console.log(title[i]);
        }
    }
</script>
@endsection