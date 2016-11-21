<div class="col-md-3 col-sm-4 content_item content_item-list">
    @include('contents.item-list', [
        'content' => $content,
    ])
    @include('contents.item-playing', [
        'content' => $content,
    ])
</div>
