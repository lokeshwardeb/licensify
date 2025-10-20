@extends('layouts.app')

@section('content')
<h1>Edit License</h1>
<form method="post" action="{{ route('licenses.update', $license) }}">
    @csrf
    <label>Customer Name:</label><br>
    <input type="text" name="customer_name" value="{{ $license->customer_name }}" required><br><br>

    <label>Expiry Date:</label><br>
    <input type="date" name="expires_at" value="{{ $license->expires_at ? $license->expires_at->format('Y-m-d') : '' }}"><br><br>

    <label>Status:</label><br>
    <select name="is_active">
        <option value="1" {{ $license->is_active ? 'selected' : '' }}>Active</option>
        <option value="0" {{ !$license->is_active ? 'selected' : '' }}>Inactive</option>
    </select><br><br>

    <button type="submit">Update License</button>
</form>
@endsection
