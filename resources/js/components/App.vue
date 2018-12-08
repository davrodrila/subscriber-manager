<template>
    <div id="app">
        <headnav></headnav>
        <div class="row">
            <div class="col s12">
                <h3 class="header grey-text darken-1 center-align">Current Subscribers</h3>
            </div>
        </div>
        <div class="row container">
            <div class="col s12 centered center-align">
                <table class="striped responsive-table centered">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                        <th>State</th>
                        <th>&nbsp;</th>
                        <th><!--Delete Button--></th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <subscriber-component
                            v-for="sub in subscribers"
                            v-bind="sub"
                            :key="sub.id">
                    </subscriber-component>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="fixed-action-btn">
            <router-link :to="{name: 'new_subscriber'}" class="btn-floating btn-large green">
                <i class="large material-icons">add</i>
            </router-link>
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


    import SubscriberComponent from "./SubscriberTableComponent";
    import headnav from "./headnav";

    export default {
        components: {SubscriberComponent, headnav},
        data() {
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
        },
        created() {
            this.read();
            window.scrollTo(0, 0);
        }

    }
</script>
