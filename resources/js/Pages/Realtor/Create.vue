<template>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input class="input" v-model.number="form.beds" type="text" />
                <div v-if="form.errors.beds" class="input-errors">
                    {{form.errors.beds}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input class="input" v-model.number="form.baths" type="text" />
                <div v-if="form.errors.baths" class="input-errors">
                    {{form.errors.baths}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Area</label>
                <input class="input" v-model.number="form.area" type="text" />
                <div v-if="form.errors.area" class="input-errors">
                    {{form.errors.area}}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input class="block w-full p-2 rounded-md shadow-sm border border-gray-300 text-gray-500" v-model="form.city" type="text" />
                <div v-if="form.errors.city" class="input-errors">
                    {{form.errors.city}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input class="input" v-model="form.code" type="text" />
                <div v-if="form.errors.code" class="input-errors">
                    {{form.errors.code}}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input class="input" v-model="form.street" type="text" />
                <div v-if="form.errors.street" class="input-errors">
                    {{form.errors.street}}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input class="input" v-model.number="form.street_nr" type="text" />
                <div v-if="form.errors.street_nr" class="input-errors">
                    {{form.errors.street_nr}}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input class="input" v-model.number="form.price" type="text" />
                <div v-if="form.errors.price" class="input-errors">
                    {{form.errors.price}}
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" class="btn-primary">Create</button>
            </div>

        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    street: null,
    code: null,
    street_nr: null,
    price: 0,
})
const create = () => form.post(route('realtor.listing.store'))
</script>


