<template>

</template>

<script>


    export default {
        props: ['id'],
        methods: {
            read(id) {
                window.axios.delete('/api/v1/subscribers/' + id).then(({data}) => {
                    this.$router.push('/show/' + this.$route.params.id);
                });
            }
        },
        created() {
            this.read(this.$route.params.id);
            window.scrollTo(0, 0);
        },
    }
</script>