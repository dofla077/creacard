@extends('dashboard')
@section('title', 'quotations')
@section('content')
    <index
        :items="{{ $quotations }}"
        :columns="{{ $columns }}"
        add-route="customers.add"

    >
    </index>
@endsection
