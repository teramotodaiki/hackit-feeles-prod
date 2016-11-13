@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($contents as $content)
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="{{ $content->thumbnail or '/image/thumbnail-default.png' }}" alt="" />
                <div class="caption">
                    <h3>{{ $content->title }}</h3>
                </div>
                <p>
                    {{ $content->description or 'No descriptions' }}
                </p>
                <p>
                    <a href="/contents/{{ $content->id }}" class="btn btn-primary" role="button">
                        Play
                    </a>
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
