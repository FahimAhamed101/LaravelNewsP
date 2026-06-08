@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">{{ $subcategory ? 'Edit Subcategory' : 'Add Subcategory' }}</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ $subcategory ? route('subcategory-update', $subcategory->id) : route('subcategory-store') }}">
                @csrf
                <div class="mb-3"><label class="form-label">Category</label><select class="form-control" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $subcategory?->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select></div>
                <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" value="{{ old('name', $subcategory?->name) }}" required></div>
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('subcategory') }}" class="btn btn-light">Cancel</a>
            </form>
        </div></div>
    </div></div>
@endsection
