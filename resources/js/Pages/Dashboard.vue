<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    name: "Posts",
    components: {
        AppLayout,
    },
    props: {
        users: {
            type: Array,
            default: [],
        },
    },
    setup(props){

        return {
            
        };
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    name
                </th>
                <th scope="col" class="px-6 py-3">
                    email
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users" :key="user.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{user.id}}
                </th>
                <td class="px-6 py-4">
                    {{user.name}}
                </td>
                <td class="px-6 py-4">
                    {{user.email}}
                </td>
            </tr>
        
        </tbody>
    </table>
</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
