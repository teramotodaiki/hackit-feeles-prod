@extends('layouts.app')

@section('content')

@include('components.alert')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('form.edit')
                </div>
                <div class="panel-body">
                    @include('contents.form', [
                        'action' => url("/contents/{$content->id}/update"),
                        'submit' => trans('form.edit'),
                    ])
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('form.danger_zone')
                </div>
                <div class="panel-body">

                    <div class="alert alert-danger" role="alert">
                        <span>
                            @lang('form.delete_content')
                        </span>
                        <button type="submit" class="btn btn-danger pull-right" onclick="event.preventDefault();
                                 document.getElementById('delete-form').submit();">
                            @lang('form.delete')
                        </button>
                    </div>

                    <form class="form-horizontal" id="delete-form" role="form" method="POST" action="/contents/{{ $content->id }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
