<template>
    <Box>
        <div>
            <Link
                :href="route('listing.show', {listing: listing.id})"
            >
                <div class="flex items-center gap-1">
                    <Price
                        :price="listing.price"
                        class="text-2xl font-bold"
                    />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAdress
                    :listing="listing"
                    class="text-gray-500"
                />
            </Link>
        </div>
    </Box>
</template>

<script setup>
import {Link} from  '@inertiajs/vue3'
import {useMonthlyPayment} from "@/Composables/useMonthlyPayment.js";
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import ListingAdress from "@/Components/ListingAdress.vue";


const props = defineProps({listing: Object})
const { monthlyPayment } = useMonthlyPayment(
    props.listing.price, 2.5, 25,
)
</script>
