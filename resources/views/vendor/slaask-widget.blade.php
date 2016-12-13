@if(env('SLAASK_WIDGET_KEY'))
<script src='https://cdn.slaask.com/chat.js'></script>
<script>
    console.log(_slaask);
    _slaask.init('{{ env('SLAASK_WIDGET_KEY') }}');
</script>
@endif
