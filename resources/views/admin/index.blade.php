@extends('layouts.admin')

@section('content')

@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12"><p class="alert alert -info">{{ Session::get('info') }}</p></div>
    </div>
@endif

<div class="row">
    <div class="col-md-12"><a href="{{ route('admin.create') }}" class="btn btn-success">New Post </a></div>
</div>

<hr>

@foreach($posts as $index=>$post)
    <div class="row">
        <div class="col-md-12"><p><strong>{{ $post['title'] }}</strong> <a href="{{ route('admin.edit', ['id' => $index]) }}">Edit </a></p></div>
    </div>
@endforeach
@endsection
