<form class="form-horizontal" role="form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">
            @lang('form.title')
        </label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{
                isset($content) ? $content->title : old('title')
            }}" required autofocus>

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">
            @lang('form.description')
        </label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control" name="description" value="{{
                isset($content) ? $content->description : old('description')
            }}">

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label for="content" class="col-md-4 control-label">
            @lang('form.content_html')
        </label>

        <div class="col-md-6">
            <input id="content" type="file" class="form-control" name="content" value="{{ old('content') }}" required accept="text/html">

            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
        <label for="thumbnail" class="col-md-4 control-label">
            @lang('form.thumbnail')
            (@lang('form.optional'))
        </label>

        <div class="col-md-6">
            <input id="thumbnail" type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}" accept="image/*">

            @if ($errors->has('thumbnail'))
                <span class="help-block">
                    <strong>{{ $errors->first('thumbnail') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{ $submit }}
            </button>
        </div>
    </div>

</form>
