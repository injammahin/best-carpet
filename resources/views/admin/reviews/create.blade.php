@extends('layouts.admin')

@section('title', 'Add Review | Mega Carpets Admin')
@section('page_title', 'Add Review')

@section('content')

    <form method="POST" action="{{ route('admin.reviews.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.reviews.partials.form')
    </form>

@endsection