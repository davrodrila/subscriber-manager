<template>
    <tr>
        <td>&nbsp;</td>
        <td><router-link :to="{name: 'show_subscriber', params: {id: id}}" class="cyan-text accent-1">{{name}}</router-link></td>
        <td>&nbsp;</td>
        <td>{{email}}</td>
        <td>&nbsp;</td>
        <td><state-icon :state='state'></state-icon></td>
        <td>&nbsp;</td>
        <td><router-link :to="{name: 'delete_subscriber', params: {id: id}}"><i class="material-icons deep-orange-text lighten-3">delete</i></router-link></td>
        <td>&nbsp;</td>
    </tr>
</template>
<script>
    import StateIcon from "./StateIcon";
    export default {
        components: {StateIcon},
        props: ['id', 'name', 'email', 'state'],


    }
</script>