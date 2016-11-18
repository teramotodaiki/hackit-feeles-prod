@extends('layouts.app')

@section('content')
<div class="content-overlay">

    <iframe sandbox="allow-scripts allow-modals allow-popups" src="{{ url($content->src) }}"></iframe>

    <nav class="content_footer navbar navbar-default">

        @if (Auth::check() && Auth::user()->id === $content->user->id)
        <a href="/contents/{{ $content->id }}/edit" class="btn btn-primary">Edit</a>
        @else
        <a href="/users/{{ $content->user_id }}" class="btn btn-link">
            {{ $content->user->name }}
        </a>
        @endif

        <div><b>{{ $content->title }}</b></div>

        <div>{{ $content->description }}</div>

    </nav>

</div>
@endsection
