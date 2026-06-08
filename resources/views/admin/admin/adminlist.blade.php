@extends('admin.layout.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <a class="btn btn-primary" href="{{ route('admin-create') }}">Add Admin</a>
                        </div>
                        <h4 class="page-title">Admins</h4>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alladminusers as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('admin-edit', $admin->id) }}">Edit</a>
                                        <a class="btn btn-sm btn-outline-{{ $admin->status ? 'warning' : 'success' }}"
                                            href="{{ route($admin->status ? 'admin-inactive' : 'admin-active', $admin->id) }}">
                                            {{ $admin->status ? 'Inactive' : 'Active' }}
                                        </a>
                                        <a class="btn btn-sm btn-outline-danger"
                                            href="{{ route('admin-delete', $admin->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
