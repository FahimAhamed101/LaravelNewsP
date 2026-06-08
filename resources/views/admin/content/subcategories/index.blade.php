@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><div class="page-title-right"><a href="{{ route('subcategory-create') }}" class="btn btn-primary">Add Subcategory</a></div><h4 class="page-title">Subcategories</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped">
                <thead><tr><th>Name</th><th>Category</th><th>Slug</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->name }}</td><td>{{ $subcategory->category?->name }}</td><td>{{ $subcategory->slug }}</td>
                            <td class="text-end">
                                <a href="{{ route('subcategory-edit', $subcategory->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="{{ route('subcategory-delete', $subcategory->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div></div>
@endsection
