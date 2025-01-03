<h1>{{ $item->heading }}</h1>
<p>{{ $item->description }}</p>

@foreach ($subitems as $subitem)
    <div>
        <img src="{{ $subitem->image }}" alt="Subitem Image">
        <p>{{ $subitem->description }}</p>
    </div>
@endforeach
