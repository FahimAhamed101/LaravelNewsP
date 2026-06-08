@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">Banners</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('banner-update') }}">
                @csrf
                @foreach (['home_one', 'home_two', 'home_three', 'home_four', 'news_category_one', 'news_details_one'] as $field)
                    <div class="mb-3">
                        <label class="form-label">{{ Str::headline($field) }} Image URL</label>
                        <input class="form-control" name="{{ $field }}" value="{{ old($field, $banner->{$field}) }}">
                    </div>
                @endforeach
                <button class="btn btn-primary">Update Banners</button>
            </form>
        </div></div>
    </div></div>
@endsection
