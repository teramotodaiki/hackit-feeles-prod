<template>
    <div class="container">
        <div class="content_loading">
            <span class="glyphicon glyphicon-refresh"></span>
        </div>
        <form id="upload-from-feeles" class="hidden" v-bind:action="'/deployments/' + contentId" method="POST">
            <input type="hidden" name="_method" value="PUT" />
            <input type="hidden" name="_token" value="" />
            <input type="hidden" name="content" value="" />
        </form>
    </div>
</template>
<script>
    export default {

        props: ['contentId', 'publishUrl'],

        mounted() {
            const $form = $('#upload-from-feeles');
            $form.find('input[name="_token"]').val(Laravel.csrfToken);

            const channel = new MessageChannel();
            channel.port1.onmessage = (event) => {
                $form.find('input[name="content"]').get(0).value = event.data;
                $form.get(0).submit();
            };

            const provider = JSON.stringify({
                publishUrl: this.publishUrl,
            });

            opener.postMessage(provider, '*', [channel.port2]);
        }
    }
</script>
