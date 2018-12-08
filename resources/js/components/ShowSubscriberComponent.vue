<template>
    <div id="app">
        <headnav></headnav>
        <div class="row container">
            <div class="row content-edit">
                <div class="col s12 m8">
                    <div class="card blue-grey lighten-4">
                        <div class="card-content ">
                            <span class="card-title">{{subscriber.name}}</span>
                            <p><span class="left">{{subscriber.email}}</span>
                                <state-icon class="state" :state="subscriber.state"></state-icon>
                            </p>
                        </div>
                        <div class="card-action">
                            <router-link :to="{name: 'edit_subscriber', params: {id: subscriber.id}}"
                                         class="card-action" style="color:#385d7a">
                                EDIT
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <show-fields v-bind:id="subscriber.id"></show-fields>
        </div>
    </div>

</template>
<style scoped>
    .content-edit {
        margin-left: 30%;
    }

    .state {
        float: right;
    }

    .link-card {
        color: #039be5;
    }

</style>
<script>
    import StateIcon from "./StateIcon";

    function Subscriber({id, name, email, state}) {
        this.id = id;
        this.name = name;
        this.email = email;
        this.state = new State(state);
    }

    function State({id, name}) {
        this.id = id;
        this.name = name;
    }


    import headnav from "./headnav";
    import ShowFields from "./ShowFields";

    export default {
        props: ['id'],
        data() {
            return {
                subscriber: '',
            }
        },
        components: {ShowFields, StateIcon, headnav},
        methods: {
            read(id) {
                window.axios.get('/api/v1/subscribers/' + id).then(({data}) => {
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