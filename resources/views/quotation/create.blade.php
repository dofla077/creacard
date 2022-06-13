@extends('dashboard')
@section('subtitle', 'create quotation')
@section('content')
    <quotation-form
        submit-action="quotations.store"
        redirect-url="quotations.index"
        :customers="{{ $customers }}"
    ></quotation-form>
@endsection
