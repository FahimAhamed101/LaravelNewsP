@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><div class="page-title-right"><a href="{{ route('photo-create') }}" class="btn btn-primary">Add Photo</a></div><h4 class="page-title">Photo Gallery</h4></div>
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-3 mb-3"><div class="card">
                    <img src="{{ str_starts_with($photo->photo_gallery, 'http') ? $photo->photo_gallery : asset($photo->photo_gallery) }}" class="card-img-top" style="height: 160px; object-fit: cover;">
                    <div class="card-body"><a href="{{ route('photo-delete', $photo->id) }}" class="btn btn-sm btn-danger">Delete</a></div>
                </div></div>
            @endforeach
        </div>
    </div></div>
@endsection
