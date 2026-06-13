@extends('layouts.admin')

@section('title', 'Add Area Size | Mega Carpets Admin')
@section('page_title', 'Add Area Size')

@section('content')

    <form method="POST" action="{{ route('admin.product-sizes.store') }}">
        @csrf

        @include('admin.product-sizes.partials.form')
    </form>

@endsection