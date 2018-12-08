<template>

</template>

<script>


    export default {
        props: ['id'],
        methods: {
            read(sub_id, id) {
                window.axios.delete('/api/v1/subscribers/' + sub_id + "/fields/" + id).then(() => {
                    this.$router.push('/show/' + sub_id);
                });
            }
        },
        created() {
            this.read(this.$route.params.sub_id,this.$route.params.id);
            window.scrollTo(0, 0);
        },
    }
</script>