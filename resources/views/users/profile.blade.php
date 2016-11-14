@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    @include('components.icon', ['src' => $user->thumbnail])
                    <h3>{{ $user->name }}</h3>
                    <h5>{{ '@' . $user->userid }}</h5>
                </div>

                @if (Auth::user()->id === $user->id)
                <div class="panel-footer">
                    <a href="{{ url("/users/{$user->id}/edit") }}" type="button" class="btn btn-primary btn-block">
                        Update
                    </a>
                </div>
                @endif

            </div>
        </div>
        <div class="col-md-10 container">
            <div class="row content_list">
            @each('contents.item', $contents, 'content')
            </div>
            <div class="text-center">
            {{ $contents->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
