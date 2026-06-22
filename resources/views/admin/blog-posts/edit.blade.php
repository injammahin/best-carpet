@extends('layouts.admin')

@section('title', 'Edit Blog Article | Mega Carpets Admin')
@section('page_title', 'Edit Blog Article')

@section('content')
    @include('admin.blog-posts.partials.form', [
        'post' => $post,
        'action' => route('admin.blog-posts.update', $post),
        'method' => 'PUT',
    ])
@endsection