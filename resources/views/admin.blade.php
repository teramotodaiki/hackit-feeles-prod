@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('form.invite_member')
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/invite') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="num" class="col-sm-4 col-xs-12 control-label">
                                @lang('form.add_invitation')
                            </label>
                            <div class="col-sm-4 col-xs-6">
                                <input id="num" type="number" class="form-control" name="num" value="{{ old('num') !== null ?  : 1 }}" min="1" required>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <button type="submit" class="btn btn-primary">
                                    @lang('form.add_invitation')
                                </button>
                            </div>
                        </div>
                    </form>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/discardInvitation') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="discard" class="col-sm-8 col-xs-6 control-label">
                                @lang('form.currently_enabled'): {{ App\Invitation::count() }}
                            </label>
                            <div class="col-sm-2 col-xs-6">
                                <button type="submit" class="btn btn-danger">
                                    @lang('form.discard')
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
