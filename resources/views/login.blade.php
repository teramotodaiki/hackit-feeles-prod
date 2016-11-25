@extends('layouts.app')

@section('content')

@include('components.alert')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('menu.login')
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/studentLogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('userid') ? ' has-error' : '' }}">
                            <label for="userid" class="col-md-4 control-label">
                                @lang('form.userid')
                            </label>

                            <div class="col-md-6">
                                <input id="userid" type="text" class="form-control" name="userid" value="{{ old('userid') }}" required autofocus>

                                @if ($errors->has('userid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">
                                @lang('form.password')
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember">
                                        @lang('form.remember')
                                    </label>
                                </div>

                                @if ($errors->has('remember'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('remember') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('menu.login')
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
