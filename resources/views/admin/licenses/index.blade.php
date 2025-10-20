@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>License Management</h1>
        <a href="{{ route('licenses.create') }}" class="btn btn-primary mb-3">Add New License</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>License Key</th>
                    <th>Software Name</th>
                    <th>Valid Until</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($licenses as $license)
                    <tr>
                        <td>{{ $license->id }}</td>
                        <td>{{ $license->license_key }}</td>
                        <td>{{ $license->software_name }}</td>
                        <td>{{ $license->valid_until }}</td>
                        <td>{{ $license->created_at }}</td>
                        <td>
                            <a href="{{ route('licenses.edit', $license->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('licenses.destroy', $license->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
