@extends('layouts.app')
@section('content')
    @foreach($posts as $post)
        <a href="{{ route('post.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
    @endforeach
    {{ $posts->links() }}
@endsection
