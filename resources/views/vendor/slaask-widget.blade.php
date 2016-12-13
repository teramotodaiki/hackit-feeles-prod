@if(env('SLAASK_WIDGET_KEY'))
<script src='https://cdn.slaask.com/chat.js'></script>
<script>
    _slaask.init('{{ env('SLAASK_WIDGET_KEY') }}');
</script>
@endif
