@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">Add Video</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('video-store') }}">
                @csrf
                <div class="mb-3"><label class="form-label">Title</label><input class="form-control" name="title" required></div>
                <div class="mb-3"><label class="form-label">Thumbnail URL</label><input class="form-control" name="image" required></div>
                <div class="mb-3"><label class="form-label">Video URL</label><input class="form-control" name="url" required></div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div></div>
    </div></div>
@endsection
