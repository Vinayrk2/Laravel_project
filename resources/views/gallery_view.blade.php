@extends('components.Layout')

@section('content')
@foreach ($items as $item)
    <div>
        <a href="/gallery/{{ $item->id }}"> 
        <h2>{{ $item->heading }}</h2></a>
        <p>{{ $item->description }}</p>
    </div>
@endforeach
@endsection
