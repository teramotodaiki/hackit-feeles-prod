@extends('layouts.app')

@section('content')
<div class="container content_list">
    <div class="row">
    @each('contents.item', $contents, 'content')
    </div>
</div>
<div class="text-center">
{{ $contents->links() }}
</div>
@endsection
