@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('post.newPost') }}">{{ __('新規投稿を作成する') }}</a>
                </div>
                <div class="card-body">
                    <a href="{{ route('post.list') }}">{{ __('投稿一覧') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
