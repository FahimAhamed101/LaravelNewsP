@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><div class="page-title-right"><a href="{{ route('video-create') }}" class="btn btn-primary">Add Video</a></div><h4 class="page-title">Video Gallery</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped">
                <thead><tr><th>Title</th><th>URL</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr><td>{{ $video->title }}</td><td>{{ $video->url }}</td><td class="text-end"><a href="{{ route('video-delete', $video->id) }}" class="btn btn-sm btn-danger">Delete</a></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div></div>
@endsection
