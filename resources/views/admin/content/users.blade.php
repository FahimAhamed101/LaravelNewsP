@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">Users</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped"><thead><tr><th>Name</th><th>Email</th><th>Phone</th></tr></thead><tbody>
                @foreach ($users as $user)
                    <tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->phone }}</td></tr>
                @endforeach
            </tbody></table>
        </div></div>
    </div></div>
@endsection
