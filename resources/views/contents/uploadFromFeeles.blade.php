@extends('layouts.app')

@section('content')

@if(session('status'))
<div class="text-center">
    Successfully Uploaded!!
</div>
@else
<upload-from-feeles content-id="{{ $content->id }}"></upload-from-feeles>
@endif

@endsection
