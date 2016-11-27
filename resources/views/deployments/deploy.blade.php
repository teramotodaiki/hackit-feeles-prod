@extends('layouts.app')

@section('content')
<upload-from-feeles content-id="{{ $content->id }}" publish-url="{{ url("/deployments/{$content->id}") }}"></upload-from-feeles>
@endsection
