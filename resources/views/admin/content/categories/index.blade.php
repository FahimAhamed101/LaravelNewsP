@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><div class="page-title-right"><a href="{{ route('category-create') }}" class="btn btn-primary">Add Category</a></div><h4 class="page-title">Categories</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped">
                <thead><tr><th>Name</th><th>Slug</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td><td>{{ $category->slug }}</td>
                            <td class="text-end">
                                <a href="{{ route('category-edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="{{ route('category-delete', $category->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div></div>
@endsection
