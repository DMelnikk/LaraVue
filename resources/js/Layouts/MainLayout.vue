<script setup>
import {Link , usePage} from '@inertiajs/vue3';
import {computed} from 'vue';

// page.props.flash.success
const page = usePage()
const flashSuccess = computed(
    () => page.props.flash.success,
)
const user = computed(
    () => page.props.user
)

const notificationCount = computed(
    () => Math.min(page.props.user.notificationCount, 9),
)
</script>

<template>




    <header class="border-b border-gray-200 bg-white w-full">
            <div class="container mx-auto">
                <nav class="p-4 flex items-center justify-between">
                    <div class="text-lg font-medium">
                        <Link :href="route('listing.index')">Listings</Link>&nbsp;
                    </div>

                    <div class="text-xl text-indigo-600 font-bold text-center">
                        <Link :href="route('listing.index')">LaraVue</Link>
                    </div>

                    <div class="flex items-center gap-4" v-if="user">
                        <Link :href="route('notification.index')"
                            class="text-gray-500 relative pr-2 py-2 text-lg">
                            🔔
                            <div v-if="notificationCount" class="absolute right-0 top-0 w-5 h-5 bg-red-700  text-white font-medium border border-white  rounded-full text-xs text-center">
                                {{ notificationCount }}
                            </div>
                        </Link>

                        <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{user.name}}</Link>
                        <Link :href="route('realtor.listing.create')" class="btn-primary">New Listing</Link>
                        <div>
                            <Link method="DELETE"  :href="route('logout')">Logout</Link>
                        </div>
                    </div>
                    <div v-else class="flex gap-2 items-center">
                        <Link :href="route('user-account.create')">Register</Link>
                        <Link :href="route('login')">Sign in</Link>
                    </div>
                </nav>
            </div>
    </header>

    <main class="mx-auto p-4 w-full max-w-screen-xl">
        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 bg-green-50
                   p-2 ">
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>






</template>


