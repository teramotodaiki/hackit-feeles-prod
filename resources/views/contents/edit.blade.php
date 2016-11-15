@extends('layouts.app')

@section('content')

@include('components.alert')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit content</div>
                <div class="panel-body">
                    @include('contents.form', [
                        'action' => url("/contents/{$content->id}/update"),
                        'submit' => 'Edit',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
