<template>
    <table>
        <thead>
        <tr>
            <th>Nom / Prénom</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-yellow-500 text-yellow-100 text-xs">VSAV J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-yellow-500 text-yellow-100 text-xs">VSAV N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-emerald-600 text-emerald-100 text-xs">VLI J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-emerald-600 text-emerald-100 text-xs">VLI N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-blue-600 text-white text-xs">FTPL CA J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-blue-600 text-white text-xs">FTPL CA N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-orange-600 text-white text-xs">FTPL COND J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-orange-600 text-white text-xs">FTPL COND N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-gray-600 text-white text-xs">FTPL BINOME J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-gray-600 text-white text-xs">FTPL BINOME N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-red-600 text-white text-xs">EPA J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-red-600 text-white text-xs">EPA N</th>
            <th v-if="type !== 'Nuit'" class="text-center w-16 bg-gray-600 text-white text-xs">VTU/VSR J</th>
            <th v-if="type !== 'Jour'" class="text-center w-16 bg-gray-600 text-white text-xs">VTU/VSR N</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="agent in agents" :key="agent.id">
            <td>{{ agent.name }} {{ agent.firstname }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-yellow-500 text-yellow-100">{{ agent.vsav_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-yellow-500 text-yellow-100">{{ agent.vsav_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-emerald-600 text-emerald-100">{{ agent.vli_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-emerald-600 text-emerald-100">{{ agent.vli_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-blue-600 text-blue-100">{{ agent.fptl_ca_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-blue-600 text-blue-100">{{ agent.fptl_ca_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-orange-600 text-orange-100">{{ agent.fptl_cond_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-orange-600 text-orange-100">{{ agent.fptl_cond_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-gray-600 text-gray-100">{{ agent.fptl_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-gray-600 text-gray-100">{{ agent.fptl_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-red-600 text-red-100">{{ agent.epa_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-red-600 text-red-100">{{ agent.epa_nuit }}</td>
            <td v-if="type !== 'Nuit'" class="text-center bg-gray-600 text-gray-100">{{ agent.reserve_jour }}</td>
            <td v-if="type !== 'Jour'" class="text-center bg-gray-600 text-gray-100">{{ agent.reserve_nuit }}</td>
        </tr>
        </tbody>
    </table>
</template>
<script setup>
const props = defineProps({
    agents: Array,
    type: String
})
</script>
