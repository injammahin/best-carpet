@extends('layouts.admin')

@section('title', 'Edit Area Size | Mega Carpets Admin')
@section('page_title', 'Edit Area Size')

@section('content')

    <form method="POST" action="{{ route('admin.product-sizes.update', $size) }}">
        @csrf
        @method('PUT')

        @include('admin.product-sizes.partials.form')
    </form>

@endsection