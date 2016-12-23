@extends('layouts.app')

@section('content')
<div class="container">
    <b>@lang('content.sort')</b>
    @foreach($sortable as $sort)
        @foreach($orderable as $order)
            <a href="{{ url("/contents?sort={$sort}&order={$order}") }}" class="btn btn-link">
                @lang("content.{$sort}_{$order}")
            </a>
        @endforeach
    @endforeach
</div>
<div class="container container-content">
    <div class="row">
    @each('contents.item', $contents, 'content')
    </div>
</div>
<div class="text-center">
{{ $contents->links() }}
</div>
@endsection
