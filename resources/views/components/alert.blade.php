@if (session('status'))
<div class="component_alert">
    <div class="alert alert-{{ session('status') }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('message') !== null ? session('message') : session('status') }}
    </div>
</div>
@endif
