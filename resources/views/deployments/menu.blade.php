@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('form.deployApp')
                </div>
                <div class="panel-body">
                    <div class="row">

                        @if($content->isAllowedBy(Auth::user()))
                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <span>
                                @lang('form.title'): <span>{{ $content->title }}</span>
                            </span>
                            <a href="{{ url("/deployments/{$content->id}/edit") }}" class="btn btn-block btn-primary">
                                @lang('form.updateApp')
                            </a>
                        </div>
                        @endif

                        <div class="col-md-6" style="margin-bottom: 1rem;">
                            <a href="{{ url("/deployments/create") }}" class="btn btn-block btn-success">
                                @lang('form.createApp')
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
