@extends('layouts.app')

@section('content')
<div class="container user_list">
    @foreach ($users as $user)
    <div class="row user_item{{ $loop->last ? ' user_item-last' : '' }}">
        <div class="col-xs-1">
            @if ($user->is_admin)
            <span class="glyphicon glyphicon-king"></span>
            @endif
        </div>
        <div class="col-xs-5">
            <a href="/users/{{ $user->id }}">{{ $user->name }}</a>
        </div>
        <div class="col-xs-3">
            <span>{{ '@' . $user->userid }}</span>
        </div>
        <div class="col-xs-3">
            <span>{{ $user->created_at }}</span>
        </div>
    </div>
    @endforeach
</div>
<div class="text-center">
{{ $users->links() }}
</div>
@endsection
