@extends('dashboard')
@section('title', 'add customers')
@section('content')
    <create-customer
        submit-action="customers.create"
        redirect-url="customers.index"
    ></create-customer>
@endsection
