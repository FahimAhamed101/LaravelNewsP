<div class="mb-4">
    <h4>Latest News</h4>
    @foreach ($newnewspost as $item)
        <div class="media mb-3">
            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                alt="{{ $item->title }}" class="mr-3" style="width: 90px; height: 65px; object-fit: cover;">
            <div class="media-body">
                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
            </div>
        </div>
    @endforeach
</div>

<div class="mb-4">
    <h4>Popular News</h4>
    @foreach ($newspopular as $item)
        <div class="media mb-3">
            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset($item->image) }}"
                alt="{{ $item->title }}" class="mr-3" style="width: 90px; height: 65px; object-fit: cover;">
            <div class="media-body">
                <a href="{{ route('news-detail', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
                <div class="text-muted small">{{ $item->view_count }} views</div>
            </div>
        </div>
    @endforeach
</div>
