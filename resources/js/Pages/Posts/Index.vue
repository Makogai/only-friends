<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import test from './test.vue';
export default {
    name: "Posts",
    components: {
        AppLayout,test
    },
    props: {
        posts: {
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
                About
                <test text="CLick ne" ></test>
            </h2>
        </template>

        <h1>MARE</h1>
    </AppLayout>
</template>
