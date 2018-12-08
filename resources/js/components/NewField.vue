<template>
    <div id="app">
        <headnav></headnav>
        <div class="row center-align container">
            <div class="row">
                <div class="col s12">
                    <h3 class="header grey-text darken-1 center-align">New Field</h3>
                </div>
            </div>
            <div class="row center-align" v-if="errors.length" style="margin-left:40%;">
                <div class="row red lighten-3 col  s4">
                    <p v-if="errors[0].title">{{errors[0].title[0]}}</p>
                    <p v-if="errors[0].type">{{errors[0].type[0]}}</p>
                </div>
            </div>
            <div class="row form-center" >
                <div class="row">
                    <div class="input-field col s4">
                        <input v-model="title" placeholder="Field Title" required>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4 ">
                        <select class = "browser-default" v-model="current_type">
                            <option v-for="type in types" :value="type.id">
                                {{ type.name }}
                            </option>
                        </select>
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

    function Type({id,name}) {
        this.id = id;
        this.name = name;
    }
    export default {
        components: {headnav},
        data() {
            return {
                errors: [],
                title: [],
                current_type: [],
                types: [],
                sub_id : [],
            }
        },
        methods: {
            read() {
                window.axios.get('/api/v1/types').then(({data}) => {
                    data.forEach(t => {
                        this.types.push(new Type(t));
                    });
                });
            },
            create() {
                window.axios.post('/api/v1/subscribers/' + this.sub_id + '/fields', {
                    'title': this.title,
                    'type_id': this.current_type
                }).then(({data}) => {
                    this.$router.push('/show/' + this.sub_id);
                }).catch((error) => {
                    this.errors.push(error.response.data);
                });
            }
        },
        created() {
            this.sub_id = this.$route.params.sub_id;
            this.read()
            window.scrollTo(0, 0);
        }

    }
</script>