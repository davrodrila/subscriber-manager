<template>
    <tr>
        <td>&nbsp;</td>
        <td>{{field.title}}</td>
        <td>&nbsp;</td>
        <td>{{field.type.name}}</td>
        <td>&nbsp;</td>
        <td><router-link :to="{name: 'delete_field', params: {sub_id: field.subscriber_id, id: field.id}}"><i class="material-icons deep-orange-text lighten-3">delete</i></router-link></td>
        <td>&nbsp;</td>
    </tr>
</template>
<script>
    export default  {
        props: ['field'],
    }
</script>