<div class="content_playing">

    <iframe data-src="{{ url($content->src) }}"></iframe>

    <div class="content_footer">

        @if (Auth::check() && Auth::user()->id === $content->user->id)
        <a href="/contents/{{ $content->id }}/edit" class="btn btn-primary">
            @lang('form.edit')
        </a>
        @else
        <a href="/users/{{ $content->user_id }}" class="btn btn-link">
            {{ $content->user->name }}
        </a>
        @endif

        <div><b>{{ $content->title }}</b></div>

        <div>{{ $content->description }}</div>

        <div class="content_open">
            <a href="{{ url('contents/' . $content->id) }}" target="_blank">
                <span class="glyphicon glyphicon-fullscreen"></span>
            </a>
        </div>

        <div class="content_close">
            <span class="glyphicon glyphicon-remove"></span>
        </div>

        <div></div>

    </div>

    <div class="content_loading">
        <span class="glyphicon glyphicon-refresh"></span>
    </div>

</div>
