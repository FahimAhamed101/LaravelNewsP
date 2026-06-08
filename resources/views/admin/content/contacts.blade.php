@extends('admin.layout.app')

@section('content')
    <div class="content"><div class="container-fluid">
        <div class="page-title-box"><h4 class="page-title">Contact Messages</h4></div>
        <div class="card"><div class="card-body">
            <table class="table table-striped"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th></tr></thead><tbody>
                @foreach ($contacts as $contact)
                    <tr><td>{{ $contact->name }}</td><td>{{ $contact->email }}</td><td>{{ $contact->phone }}</td><td>{{ $contact->comments }}</td></tr>
                @endforeach
            </tbody></table>
        </div></div>
    </div></div>
@endsection
