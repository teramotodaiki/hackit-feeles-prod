<div class="col-md-3 col-sm-4 content_item">
    <div onclick="location.assign('/contents/{{ $content->id }}')">
        <div class="content_thumbnail" style="background-image: url({{ $content->thumbnail or '/image/thumbnail-default.png' }})">
            <div>
            {{ $content->description or 'No descriptions' }}
            </div>
        </div>
        <div class="content_article">
            <h3>{{ $content->title }}</h3>
        </div>
    </div>
</div>
