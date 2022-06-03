@extends('layouts.app')
@section('content')
    <div id="showPost" data-post-id="{{ $id }}"></div>
    @include('partials.post-control', ['id' => $id])
@endsection
