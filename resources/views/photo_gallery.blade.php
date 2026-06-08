@extends('user.body.app')

@section('title')
    Photo Gallery | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Photo Gallery</h2>
        <div class="row">
            @foreach ($photogalleries as $photo)
                <div class="col-md-4 mb-4">
                    <img src="{{ str_starts_with($photo->photo_gallery, 'http') ? $photo->photo_gallery : asset($photo->photo_gallery) }}"
                        alt="Gallery image" class="img-fluid w-100" style="height: 230px; object-fit: cover;">
                </div>
            @endforeach
        </div>
    </div>
@endsection
