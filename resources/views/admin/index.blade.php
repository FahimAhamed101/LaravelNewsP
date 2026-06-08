@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($stats as $label => $value)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-muted text-uppercase mt-0">{{ Str::headline($label) }}</h5>
                                <h2>{{ $value }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-1">Welcome, {{ Auth::guard('admin')->user()?->name }}</h5>
                            <p class="mb-3 text-muted">Manage articles, media, readers, reviews, and site settings from this dashboard.</p>

                            <h5>Latest News</h5>
                            <table class="table table-sm">
                                <tbody>
                                    @foreach ($latestNews as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('news-edit', $item->id) }}">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Quick Actions</h5>
                            <a class="btn btn-primary btn-sm mb-2" href="{{ route('news-create') }}">Add News</a>
                            <a class="btn btn-info btn-sm mb-2" href="{{ route('category-create') }}">Add Category</a>
                            <a class="btn btn-secondary btn-sm mb-2" href="{{ route('banner') }}">Update Banners</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
