<template>
    <div class="container mx-auto">
        <header class="my-8 bg-white p-4 rounded shadow flex items-center justify-between">
            <h1 class="font-medium text-xl">Ajouter un utilisateur</h1>
        </header>

        <div class="bg-white p-8 rounded shadow grid grid-cols-2 gap-8 ">
            <VInput label="Nom" v-model="form.name" :error="form.errors.name"/>
            <VInput label="Email" v-model="form.email" :error="form.errors.email"/>
            <div>
                <VLabel>Section</VLabel>
                <v-select :clearable="false" :options="[1,2,3,4]"
                          v-model="form.section"></v-select>
                <InputError :message="form.errors.section"></InputError>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <PrimaryButton @click="store" :form>Ajouter</PrimaryButton>
        </div>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VInput from "@/Components/Base/VInput.vue";
import {useForm} from "@inertiajs/vue3";
import VSelect from 'vue-select'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VLabel from "@/Components/Base/VLabel.vue";
import InputError from "@/Components/InputError.vue";

defineOptions({layout: AuthenticatedLayout})

const form = useForm({
    name: '',
    email: '',
    section: 1,
})

function store() {
    form.post(route('users.store'))
}

</script>
