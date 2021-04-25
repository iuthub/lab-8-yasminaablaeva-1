@extends('layouts.master')

@section('content')
    <div class="col-md-12 text-center">
        <h1 class="post-title">{{ $post['title'] }}</h1>
        <p>{{ $post['content'] }}</p>
    </div>
@endsection
