


<template>
    <div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
        <Box  v-if="listing.images.length" class="md:col-span-7 flex items-center w-full">
            <div class="grid grid-cols-2 gap-1">
                <img v-for="image in listing.images" :key="image.id" :src="image.src"/>
            </div>

        </Box>

        <EmptyState v-else class="md:col-span-7 flex items-center"> No images </EmptyState>

       <div class="md:col-span-5 flex flex-col gap-4">
           <Box>
               <template #header>
                   Basic info
               </template>
               <Price :price="listing.price" class="text-2xl font-bold" />
               <ListingSpace :listing="listing" class="text-lg"/>
               <ListingAdress :listing="listing" class="text-gray-500"/>
           </Box>

           <Box>
               <template #header>
                   Monthly Payment
               </template>
               <div>

                   <label class="label">Interest rate ({{interestRate}})</label>
                   <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                    class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer"/>

                   <label class="label">Duration ({{duration}}) years</label>
                   <input v-model.number="duration" type="range" min="3" max="40" step="1"
                          class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer"/>
                   <div class="text-gray-600 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                       <Price :price="monthlyPayment" class="text-3xl" />
                   </div>

                   <div class="mt-2 text-gray-500">
                       <div class="flex justify-between">
                           <div>Total Paid</div>
                           <div>
                               <Price :price="totalPaid" class="font-medium"/>
                           </div>
                       </div>

                       <div class="flex justify-between">
                           <div>Principal Paid</div>
                           <div>
                               <Price :price="listing.price" class="font-medium"/>
                           </div>
                       </div>


                       <div class="flex justify-between">
                           <div>Interest Paid</div>
                           <div>
                               <Price :price="totalInterest" class="font-medium"/>
                           </div>
                       </div>


                   </div>

               </div>
           </Box>
           <MakeOffer
               v-if="user && !offerMade"
               @offer-updated="offer = $event"
               :listing-id="listing.id"
               :price="listing.price" />
           <OfferMade v-if="user && offerMade" :offer="offerMade" />
       </div>
    </div>
</template>


<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import ListingAdress from "@/Components/ListingAdress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import {useMonthlyPayment} from "@/Composables/useMonthlyPayment.js";
import {computed, ref} from "vue";
import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
import OfferMade from "@/Pages/Listing/Show/Components/OfferMade.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

const interestRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
    offerMade: Object,
});

const offer = ref(props.listing.price)
const { monthlyPayment ,  totalPaid, totalInterest} = useMonthlyPayment(offer, interestRate, duration);

const page = usePage()

const user = computed(
    () => page.props.user
)


</script>

