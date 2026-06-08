@if ($newsItems->count())
    <div class="row">
        @foreach ($newsItems as $item)
            <div class="col-md-4 mb-4">
                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">
                    <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                        alt="{{ $item->title }}" class="img-fluid mb-2 w-100" style="height: 220px; object-fit: cover;">
                    <h5>{{ $item->title }}</h5>
                </a>
                <p>{{ Str::limit($item->details, 120) }}</p>
            </div>
        @endforeach
    </div>
@else
    <p>No news found.</p>
@endif
