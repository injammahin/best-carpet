@extends('layouts.admin')

@section('title', 'Add Blog Article | Mega Carpets Admin')
@section('page_title', 'Add Blog Article')

@section('content')
    @include('admin.blog-posts.partials.form', [
        'post' => $post,
        'action' => route('admin.blog-posts.store'),
        'method' => 'POST',
    ])
@endsection