@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload</div>
                <div class="panel-body">
                    @include('contents.form', [
                        'action' => url('/contents'),
                        'submit' => 'Upload',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
