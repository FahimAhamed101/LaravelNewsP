@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">Add Photo</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('photo-store') }}">
                @csrf
                <div class="mb-3"><label class="form-label">Photo URL</label><input class="form-control" name="photo_gallery" required></div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div></div>
    </div></div>
@endsection
