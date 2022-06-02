@extends('layouts.app')
@section('content')
    <div class="posts">
        <div class="card">
            <div class="page-title card-body text-center">
                <h4 class="card-title m-b-0">Posts</h4>
            </div>
            <ul class="list-style-none">
                @foreach($posts as $post)
                    <li class="d-flex no-block card-body">
                        <a href="{{ route('post.show', ['id' => $post->id]) }}">
                            <div>
                                <div class="time">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('Y.m.d') }}</div>
                                <div class="m-b-0 font-medium p-0">{{ $post->title }}</div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="area-pagination">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
