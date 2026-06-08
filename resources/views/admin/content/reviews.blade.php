@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">{{ $title }}</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped">
                <thead><tr><th>User</th><th>News</th><th>Comment</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            <td>{{ $review->user?->name }}</td><td>{{ $review->news?->title }}</td><td>{{ $review->comments }}</td>
                            <td class="text-end">
                                @unless ($review->status)<a href="{{ route('review-approve', $review->id) }}" class="btn btn-sm btn-success">Approve</a>@endunless
                                <a href="{{ route('review-delete', $review->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div></div>
@endsection
