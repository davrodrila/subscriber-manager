<template>
    <div id="app">
        <headnav></headnav>
        <div class="row center-align container">
            <div class="row">
                <div class="col s12">
                    <h3 class="header grey-text darken-1 center-align">New Subscriber</h3>
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
                        <input v-model="name" placeholder="Subscriber Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4 ">
                        <input v-model="email" placeholder="Subscriber eMail" required type="email">
                    </div>
                </div>
                <div class="row">
                    <button @click="create()" class="btn waves-effect waves-light" type="submit" name="action">Add
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

    export default {
        components: {headnav},
        data() {
            return {
                errors: [],
                name: [],
                email: [],
            }
        },
        methods: {
            read() {
            },
            create() {
                this.errors = [];
                window.axios.post('/api/v1/subscribers', {
                    'name': this.name,
                    'email': this.email,
                }).then(({data}) => {
                    this.$router.push('/');
                }).catch((error) => {
                    this.errors.push(error.response.data);
                });
            }
        },
        created() {
            window.scrollTo(0, 0);
        }

    }
</script>