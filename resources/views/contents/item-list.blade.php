<div class="content_list content_toggle" data-content="{{ $content->id }}">
    <div class="content_thumbnail" style="background-image: url({{ $content->thumbnail or '/image/thumbnail-default.png' }})">
        <div>
        {{
            $content->description or trans('content.no_descriptions')
        }}
        </div>
    </div>
    <div class="content_article">
        <h3>{{ $content->title }}</h3>
        @if (Auth::check() && $content->isAllowedBy(Auth::user()))
        <a href="{{ url("/contents/{$content->id}/edit") }}" class="btn btn-primary btn-sm" onclick="arguments[0].stopPropagation()">
            @lang('form.edit')
        </a>
        @else
        <a href="{{ url("/users/{$content->user_id}") }}" class="btn btn-link" title="{{ $content->user->name }}" onclick="arguments[0].stopPropagation()">
            {{ $content->user->name }}
        </a>
        @endif
        <a href="{{ $content->src }}" target="_blank" class="btn btn-link" onclick="arguments[0].stopPropagation()">
            @lang('content.open_tab')
        </a>
    </div>
</div>
