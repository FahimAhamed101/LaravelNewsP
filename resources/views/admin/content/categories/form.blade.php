@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">{{ $category ? 'Edit Category' : 'Add Category' }}</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ $category ? route('category-update', $category->id) : route('category-store') }}">
                @csrf
                <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" value="{{ old('name', $category?->name) }}" required></div>
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('category') }}" class="btn btn-light">Cancel</a>
            </form>
        </div></div>
    </div></div>
@endsection
