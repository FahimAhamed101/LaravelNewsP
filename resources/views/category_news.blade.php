@extends('user.body.app')

@section('title')
    {{ $categoryName->name ?? 'Category News' }} | Online Easy News
@endsection

@section('content')
    <div class="container">
        @if (!empty($banner?->news_category_one))
            <div class="mb-4 text-center">
                <img src="{{ str_starts_with($banner->news_category_one, 'http') ? $banner->news_category_one : asset($banner->news_category_one) }}"
                    alt="Advertisement" class="img-fluid">
            </div>
        @endif

        <h2 class="mb-4">{{ $categoryName->name ?? 'Category News' }}</h2>

        <div class="row">
            <div class="col-lg-8">
                @if ($recentNews)
                    <div class="mb-4">
                        <a href="{{ route('news-detail', [$recentNews->id, $recentNews->slug]) }}">
                            <img src="{{ str_starts_with($recentNews->image, 'http') ? $recentNews->image : asset($recentNews->image) }}"
                                alt="{{ $recentNews->title }}" class="img-fluid mb-3 w-100">
                            <h3>{{ $recentNews->title }}</h3>
                        </a>
                        <p>{{ Str::limit($recentNews->details, 180) }}</p>
                    </div>
                @endif

                <div class="row">
                    @foreach ($relatedTwoNews as $item)
                        <div class="col-md-6 mb-4">
                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                                    alt="{{ $item->title }}" class="img-fluid mb-2">
                                <h5>{{ $item->title }}</h5>
                            </a>
                        </div>
                    @endforeach
                </div>

                @foreach ($otherNews as $item)
                    <div class="media mb-4">
                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                            alt="{{ $item->title }}" class="mr-3" style="width: 170px; height: 110px; object-fit: cover;">
                        <div class="media-body">
                            <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                <h5>{{ $item->title }}</h5>
                            </a>
                            <p>{{ Str::limit($item->details, 130) }}</p>
                        </div>
                    </div>
                @endforeach

                {{ $otherNews->links() }}
            </div>

            <div class="col-lg-4">
                @include('partials.news-sidebar', ['newnewspost' => $newnewspost, 'newspopular' => $newspopular])
            </div>
        </div>
    </div>
@endsection
