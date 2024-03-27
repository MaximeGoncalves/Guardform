<template>
    <div class="bg-gray-50 h-screen">
        <div class="container mx-auto py-10 px-8">
            <h1 class="text-3xl font-semibold mb-6">Garde du {{ moment(guard.date).locale('fr').format('LL') }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-4 items-start">
                <OneCardItem title="Officier de garde" :day="day.officier?.name" :night="night.officier?.name" />
                <OneCardItem title="Adjudant de garde" :day="day.adjudant?.name" :night="night.adjudant?.name" />
                <OneCardItem title="Cadre Sécurité" :day="day.secu?.name" :night="night.secu?.name"/>
                <OneCardItem title="Planton" :day="day.planton?.name" :night="night.planton?.name"/>

                <VsavCardItem title="VSAV 1"
                              :ca_day="day.ca_vsav1"
                              :ca_night="night.ca_vsav1"
                              :cond_day="day.cond_vsav1"
                              :cond_night="night.cond_vsav1"
                              :eq_day="day.eq_vsav1"
                              :eq_night="night.eq_vsav1"
                />

                <VsavCardItem title="VSAV 2"
                              :ca_day="day.ca_vsav2"
                              :ca_night="night.ca_vsav2"
                              :cond_day="day.cond_vsav2"
                              :cond_night="night.cond_vsav2"
                              :eq_day="day.eq_vsav2"
                              :eq_night="night.eq_vsav2"
                />
                <VsavCardItem title="VSAV 3"
                              :ca_day="day.ca_vsav3"
                              :ca_night="night.ca_vsav3"
                              :cond_day="day.cond_vsav3"
                              :cond_night="night.cond_vsav3"
                              :eq_day="day.eq_vsav3"
                              :eq_night="night.eq_vsav3"
                />
                <VliCardItem title="VLI" :cond_day="day.vli" :cond_night="night.vli"/>
                <div class="space-y-4">
                    <FptlCardItem title="FPTL"
                                  :ca_day="day.ca_fptl"
                                  :ca_night="night.ca_fptl"
                                  :cond_day="day.cond_fptl"
                                  :cond_night="night.cond_fptl"
                                  :ce1_day="day.ce1_fptl"
                                  :ce1_night="night.ce1_fptl"
                                  :ce2_day="day.ce2_fptl"
                                  :ce2_night="night.ce2_fptl"
                                  :eq1_day="day.eq1_fptl"
                                  :eq1_night="night.eq1_fptl"
                                  :eq2_day="day.eq2_fptl"
                                  :eq2_night="night.eq2_fptl"
                    />
                    <VliCardItem title="EPA" :cond_day="day.epa" :cond_night="night.epa"/>

                </div>
                <FptlCardItem title="FPT"
                              :ca_day="day.ca_fpt"
                              :ca_night="night.ca_fpt"
                              :cond_day="null"
                              :cond_night="null"
                              :ce1_day="null"
                              :ce1_night="null"
                              :ce2_day="null"
                              :ce2_night="null"
                              :eq1_day="null"
                              :eq1_night="null"
                              :eq2_day="null"
                              :eq2_night="null"
                />
                <div class="space-y-4">
                    <VsavCardItem title="VTU"
                                  :ca_day="day.ca_vtu"
                                  :ca_night="night.ca_vtu"
                                  :cond_day="day.cond_vtu"
                                  :cond_night="night.cond_vtu"
                                  :eq_day="day.eq_vtu"
                                  :eq_night="night.eq_vtu"
                    />
                    <VsavCardItem title="VSR"
                                  :ca_day="day.ca_vsr"
                                  :ca_night="night.ca_vsr"
                                  :cond_day="day.cond_vsr"
                                  :cond_night="night.cond_vsr"
                                  :eq_day="day.eq_vsr"
                                  :eq_night="night.eq_vsr"
                    />
                </div>
                <div></div>
                <VliCardItem title="Pharmacie" :cond_day="day.pharmacie" :cond_night="null"></VliCardItem>
                <VliCardItem title="Remise" :cond_day="day.remise" :cond_night="null"></VliCardItem>
                <VliCardItem title="Cuisine" :cond_day="day.cuisine" :cond_night="null"></VliCardItem>
            </div>
        </div>
    </div>
</template>

<script setup>
import moment from "moment/min/moment-with-locales";
import {computed} from "vue";
import VsavCard from "@/Pages/Form/vehicles/VsavCard.vue";
import VsavCardItem from "@/Pages/Recap/VsavCardItem.vue";
import FptCard from "@/Pages/Form/vehicles/FptCard.vue";
import FptlCardItem from "@/Pages/Recap/FptlCardItem.vue";
import VliCardItem from "@/Pages/Recap/VliCardItem.vue";
import OneCardItem from "@/Pages/Recap/OneCardItem.vue";

const props = defineProps({
    guard: Object
})

const day = computed(() => props.guard.forms.filter(item => !item.is_night)[0])
const night = computed(() => props.guard.forms.filter(item => item.is_night)[0])
</script>
