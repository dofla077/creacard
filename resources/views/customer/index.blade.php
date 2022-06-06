@extends('dashboard')
@section('title', 'customers')
@section('content')
    <index
        :items="{{ $customers }}"
        :columns="{{ $columns }}"
        add-route="customers.add"

    >
    </index>
@endsection
