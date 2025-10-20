@extends('layouts.app')

@section('content')
<h1>Create License</h1>
<form method="post" action="{{ route('licenses.store') }}">
    @csrf
    <label>Customer Name:</label><br>
    <input type="text" name="customer_name" required><br><br>

    <label>Expiry Date:</label><br>
    <input type="date" name="expires_at"><br><br>

    <button type="submit">Create License</button>
</form>
@endsection
