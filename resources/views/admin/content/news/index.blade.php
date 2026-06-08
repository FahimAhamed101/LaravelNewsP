@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><div class="page-title-right"><a href="{{ route('news-create') }}" class="btn btn-primary">Add News</a></div><h4 class="page-title">News Articles</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped">
                <thead><tr><th>Title</th><th>Category</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($newsItems as $item)
                        <tr>
                            <td>{{ $item->title }}</td><td>{{ $item->category?->name }}</td><td>{{ $item->status ? 'Published' : 'Draft' }}</td>
                            <td class="text-end">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                <a href="{{ route('news-toggle', $item->id) }}" class="btn btn-sm btn-outline-warning">Toggle</a>
                                <a href="{{ route('news-edit', $item->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="{{ route('news-delete', $item->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div></div>
@endsection
