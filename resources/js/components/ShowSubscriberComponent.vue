<template>
    <div id="app">
        <headnav></headnav>
        <div class="row">
            <div class="col s12">
                <h3 class="header grey-text darken-1 center-align">Show details of {{subscriber.name}}</h3>
            </div>
        </div>
    </div>
</template>
<script>
    function Subscriber({id, name,email, state}) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.state = new State(state);
    }

    function State({id, name}) {
        this.id = id;
        this.name = name;
    }

    function Field({id, type}) {
        this.id = id;
        this.type = new Type(type);
    }

    import headnav from "./headnav";
    export default {
        props: ['id'],
        data() {
            return {
                subscriber : '',
            }
        },
        components: {headnav},
        methods: {
            read(id) {
                window.axios.get('/api/v1/subscribers/' + id ).then(({data}) => {
                        this.subscriber = new Subscriber(data);
                });
                window.axios.get('/api/v1/subscribers/' + id +'/fields').then(({data}) => {
                    this.subscriber = new Subscriber(data);
                });
            }
        },
        created() {
            this.read(this.$route.params.id);
            window.scrollTo(0, 0);
        }
    }
</script>