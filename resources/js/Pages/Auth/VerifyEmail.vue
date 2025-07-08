

<template>
 <div>You need to be verified first to see this page!</div>
    <div>
        <Link :href="route('verification.send')"
              method="post"
              class="text-indigo-600">Resend verification email </Link>
    </div>
</template>


<script setup>
import {Link} from '@inertiajs/vue3'
</script>


