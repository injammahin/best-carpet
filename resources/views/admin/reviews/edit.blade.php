@extends('layouts.admin')

@section('title', 'Edit Review | Mega Carpets Admin')
@section('page_title', 'Edit Review')

@section('content')

    <form method="POST" action="{{ route('admin.reviews.update', $review) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.reviews.partials.form')
    </form>

@endsection