<template>
    <div id="app">
        <headnav></headnav>
        <h1>Test {{name}}</h1>
    </div>
</template>
<script>
/*    function Subscriber({id, name, state}) {
        this.id = id;
        this.name = name;
        this.state = new State(state);
    }

    function State({id, name}) {
        this.id = id;
        this.name = name;
    }


    import SubscriberComponent from "./SubscriberTableComponent";*/
    import headnav from "./headnav";
    export default {
        components: {headnav},
        /*data() {
            return {
                subscribers: []
            }
        },
        methods: {
            read() {
                window.axios.get('/api/v1/subscribers').then(({data}) => {
                    data.forEach(sub => {
                        this.subscribers.push(new Subscriber(sub));
                    });
                });
            }
        },*/
        created() {
            window.scrollTo(0, 0);
        }

    }
</script>