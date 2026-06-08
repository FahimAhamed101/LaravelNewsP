@extends('user.body.app')

@section('title')
    {{ $admin->name }} News | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">News By {{ $admin->name }}</h2>
        @include('partials.news-list', ['newsItems' => $news])
    </div>
@endsection
