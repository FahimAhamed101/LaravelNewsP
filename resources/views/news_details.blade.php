@extends('user.body.app')

@section('title')
    {{ $news->title }} | Online Easy News
@endsection

@section('content')
    <div class="container">
        @if (!empty($banner?->news_details_one))
            <div class="row mb-3">
                <div class="col-12 text-center">
                    <img src="{{ str_starts_with($banner->news_details_one, 'http') ? $banner->news_details_one : asset($banner->news_details_one) }}"
                        alt="Advertisement" class="img-fluid">
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 col-md-12">
                <article class="single-news-wrapper">
                    <h1 class="mb-3">{{ $news->title }}</h1>

                    <div class="mb-3 text-muted">
                        <span>{{ optional($news->created_at)->format('M d, Y') }}</span>
                        @if ($news->category)
                            <span> | {{ $news->category->name }}</span>
                        @endif
                        @if ($news->admin)
                            <span> | By {{ $news->admin->name }}</span>
                        @endif
                    </div>

                    @if ($news->image)
                        <img src="{{ str_starts_with($news->image, 'http') ? $news->image : asset($news->image) }}"
                            alt="{{ $news->title }}" class="img-fluid mb-4 w-100">
                    @endif

                    <div class="news-details-content mb-4">
                        {!! nl2br(e($news->details)) !!}
                    </div>

                    @if (!empty($tags_all))
                        <div class="mb-4">
                            @foreach ($tags_all as $tag)
                                @if (trim($tag) !== '')
                                    <span class="badge badge-secondary mr-1">{{ trim($tag) }}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </article>

                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="mb-3">Leave a Review</h4>

                        @auth('web')
                            <form method="POST" action="{{ route('review-post') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $news->id }}">
                                <div class="form-group">
                                    <textarea name="comments" class="form-control" rows="4" placeholder="Write your comment" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        @else
                            <p class="mb-0">
                                <a href="{{ route('user-login') }}">Login</a> to submit a review.
                            </p>
                        @endauth
                    </div>
                </div>

                @if ($relatedNews->count())
                    <div class="mb-4">
                        <h3 class="mb-3">Related News</h3>
                        <div class="row">
                            @foreach ($relatedNews as $item)
                                <div class="col-md-6 mb-3">
                                    <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                        @if ($item->image)
                                            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                                                alt="{{ $item->title }}" class="img-fluid mb-2">
                                        @endif
                                        <h5>{{ $item->title }}</h5>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="mb-4">
                    <h4>Latest News</h4>
                    @foreach ($newnewspost as $item)
                        <div class="media mb-3">
                            @if ($item->image)
                                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                                    alt="{{ $item->title }}" class="mr-3" style="width: 90px; height: 65px; object-fit: cover;">
                            @endif
                            <div class="media-body">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                    {{ $item->title }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <h4>Popular News</h4>
                    @foreach ($newspopular as $item)
                        <div class="media mb-3">
                            @if ($item->image)
                                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                                    alt="{{ $item->title }}" class="mr-3" style="width: 90px; height: 65px; object-fit: cover;">
                            @endif
                            <div class="media-body">
                                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                                    {{ $item->title }}
                                </a>
                                <div class="text-muted small">{{ $item->view_count }} views</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
