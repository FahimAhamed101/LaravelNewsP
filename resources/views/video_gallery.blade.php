@extends('user.body.app')

@section('title')
    Video Gallery | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Video Gallery</h2>
        <div class="row">
            @foreach ($videogalleries as $video)
                <div class="col-md-4 mb-4">
                    <img src="{{ str_starts_with($video->image, 'http') ? $video->image : asset($video->image) }}"
                        alt="{{ $video->title }}" class="img-fluid w-100 mb-2" style="height: 210px; object-fit: cover;">
                    <h5>{{ $video->title }}</h5>
                    <a href="{{ $video->url }}" target="_blank">Watch Video</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
