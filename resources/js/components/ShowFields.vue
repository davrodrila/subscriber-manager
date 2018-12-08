<template>
    <div class="row">
        <div class="col s12 m12 centered center-align">
            <table class="striped responsive-table centered">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                    <th>Type</th>
                    <th>&nbsp;</th>
                    <th><!--Delete Button--></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <field-component
                        v-for="field in fields"
                        v-bind:field="field"
                        :key="field.id">
                </field-component>
                </tbody>
            </table>
            <div class="fixed-action-btn">
                <router-link :to="{name: 'new_field', params: {sub_id: this.$route.params.id}}" class="btn-floating btn-large green">
                    <i class="large material-icons">add</i>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
    function Field({id, subscriber_id, title, type}) {
        this.id = id;
        this.title = title;
        this.subscriber_id = subscriber_id;

        this.type = new Type(type);
    }

    function Type({id, name}) {
        this.id = id;
        this.name = name;
    }
    import headnav from "./headnav";
    import FieldComponent from "./FieldComponent";
    export default {

        components: {headnav, FieldComponent},
        data() {
            return {
                fields: []
            }
        },
        methods: {
            read(id) {
                window.axios.get('/api/v1/subscribers/' + id + "/fields").then(({data}) => {
                    data.forEach(f => {
                        this.field = this.fields.push(new Field(f));
                    });

                });
            },
        },
        created() {
            this.read(this.$route.params.id);
            window.scrollTo(0, 0);
        }

    }
</script>