@extends('layouts.app')

@section('content')
<div class="content-overlay">

    <iframe src="{{ url($content->src) }}"></iframe>

    <nav class="content_footer navbar navbar-default">

        @if (Auth::check() && $content->isAllowedBy(Auth::user()))
        <a href="/contents/{{ $content->id }}/edit" class="btn btn-primary">
            @lang('form.edit')
        </a>
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
