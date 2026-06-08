@extends('user.body.app')

@section('title')
    Search Results | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Search Results For "{{ $item }}"</h2>
        @include('partials.news-list', ['newsItems' => $news])
    </div>
@endsection
