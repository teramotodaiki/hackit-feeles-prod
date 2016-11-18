<div class="col-md-3 col-sm-4 content_item">
    <div onclick="location.assign('/contents/{{ $content->id }}')">
        <div class="content_thumbnail" style="background-image: url({{ $content->thumbnail or '/image/thumbnail-default.png' }})">
            <div>
            {{
                $content->description or trans('content.no_descriptions')
            }}
            </div>
        </div>
        <div class="content_article">
            <h3>{{ $content->title }}</h3>
            @if (Auth::check() && $content->user_id === Auth::user()->id)
            <a href="/contents/{{ $content->id }}/edit" class="btn btn-primary btn-sm">
                @lang('form.edit')
            </a>
            @else
            <a href="/users/{{ $content->user_id }}" class="btn btn-link" title="{{ $content->user->name }}">
                {{ $content->user->name }}
            </a>
            @endif
        </div>
    </div>
</div>
