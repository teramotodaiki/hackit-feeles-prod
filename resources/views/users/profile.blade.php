@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-6">
                            @include('components.icon', ['src' => $user->thumbnail])
                        </div>
                        <div class="col-md-12 col-xs-6">
                            <h3>{{ $user->name }}</h3>
                            <h5>{{ '@' . $user->userid }}</h5>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->id === $user->id)
                <div class="panel-footer">
                    <a href="{{ url("/users/{$user->id}/edit") }}" type="button" class="btn btn-primary btn-block">
                        @lang('form.edit_profile')
                    </a>
                </div>
                @endif

            </div>
        </div>
        <div class="col-md-9 col-sm-12 container">
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
