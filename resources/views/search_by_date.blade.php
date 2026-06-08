@extends('user.body.app')

@section('title')
    Search By Date | Online Easy News
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">News From {{ $formatDate }}</h2>
        @include('partials.news-list', ['newsItems' => $news])
    </div>
@endsection
