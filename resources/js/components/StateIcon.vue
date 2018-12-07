<template>
    <span>
        <span v-if="state.name==='active'">
            <i class="material-icons green-text" title="Active">check</i>
        </span>
        <span v-else-if="state.name==='junk'">
            <i class="material-icons grey-text lighten-4" title="Junk">report</i>
        </span>
        <span v-else-if="state.name==='unconfirmed'">
            <i class="material-icons grey-text lighten-4" title="Unconfirmed">hourglass_empty</i>
        </span>
        <span v-else-if="state.name==='unsubscribed'">
            <i class="material-icons grey-text lighten-4" title="Unsubscribed">not_interested</i>
        </span>
        <span v-else-if="state.name==='bounced'">
            <i class="material-icons grey-text lighten-4" title="Bounced">rotate_right</i>
        </span>
    </span>
</template>
<script>
    export default{
        props: ['state'],
    }
</script>