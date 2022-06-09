@extends('dashboard')
@section('subtitle', 'create customer')
@section('content')
    <customer-form
        submit-action="customers.store"
        redirect-url="customers.index"
    ></customer-form>
@endsection
