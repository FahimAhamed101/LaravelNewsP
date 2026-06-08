@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">SEO Settings</h4></div>
        <div class="card"><div class="card-body">
            <form method="POST" action="{{ route('seo-update') }}">
                @csrf
                @foreach (['meta_title', 'meta_author', 'meta_keyword', 'meta_description'] as $field)
                    <div class="mb-3">
                        <label class="form-label">{{ Str::headline($field) }}</label>
                        <input class="form-control" name="{{ $field }}" value="{{ old($field, $seo->{$field}) }}">
                    </div>
                @endforeach
                <button class="btn btn-primary">Update SEO</button>
            </form>
        </div></div>
    </div></div>
@endsection
