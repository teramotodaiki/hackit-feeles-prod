@extends('layouts.app')

@section('content')
<div class="content-overlay">
    <iframe sandbox="allow-scripts" src="{{ url($content->src) }}"></iframe>
</div>
<div class="container-fluid">
</div>
@endsection
