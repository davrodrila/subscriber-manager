<template>
    <div id="app">
        <headnav></headnav>
        <div class="row center-align container">
            <div class="row">
                <div class="col s12">
                    <h3 class="header grey-text darken-1 center-align">Edit Subscriber</h3>
                </div>
            </div>
            <div class="row center-align" v-if="errors.length" style="margin-left:40%;">
                <div class="row red lighten-3 col  s4">
                    <p v-if="errors[0].name">{{errors[0].name[0]}}</p>
                    <p v-if="errors[0].email">{{errors[0].email[0]}}</p>
                </div>
            </div>
            <div class="row form-center" >
                <div class="row">
                    <div class="input-field col s4">
                        <input v-model="subscriber.name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4 ">
                        <input v-model="subscriber.email" required type="email">
                    </div>
                </div>
                <div class="row">
                    <button @click="update()" class="btn waves-effect waves-light" type="submit" name="action">Edit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .form-center {
        margin-left:40%;
    }
</style>
<script>
    import headnav from "./headnav";

    function Subscriber({id, name, email}) {
        this.id = id;
        this.name = name;
        this.email = email;
    }

    export default {

        components: {headnav},
        data() {
            return {
                subscriber: '',
                errors: [],
                sub_id: [],
            }
        },
        methods: {
            read(id) {
                window.axios.get('/api/v1/subscribers/' + id).then(({data}) => {
                    this.subscriber = new Subscriber(data);
                });
            },update() {
                this.errors = [];
                window.axios.put('/api/v1/subscribers/' + this.subscriber.id, this.subscriber)
                    .then(({data}) => {
                        this.$router.push('/show/' + this.id);
                    })
                    .catch((error) => {
                        if ('response' in error) {
                            this.errors.push(error.response.data);
                        }
                    });

                    ;
            }
        },
        created() {
            this.id = this.$route.params.id;
            this.read(this.$route.params.id)
            window.scrollTo(0, 0);
        }

    }
</script>