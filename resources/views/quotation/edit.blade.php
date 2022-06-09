@extends('dashboard')
@section('subtitle', 'create quotation')
@section('content')
    <quotation-form
        submit-action="quotations.update"
        update="update"
        redirect-url="quotations.index"
        :customers="{{ $customers }}"
        :quotation="{{ $quotation }}"
    ></quotation-form>
@endsection
