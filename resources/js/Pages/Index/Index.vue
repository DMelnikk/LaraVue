<script setup>
     import {Link} from '@inertiajs/vue3';
     // defineprops мы передаем данные таким образом из контроллера
     const props = defineProps({
         message: String
     })
</script>





<template>

        <h1>Index vue</h1>
        <Link href="/hello">Show page</Link>
        <div>The message is {{message}}</div>

</template>

<style scoped>

</style>
