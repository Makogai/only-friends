<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    name: "Post",
    components: {
        AppLayout,test
    },
    props: {
        post: {
            type: Object,
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
                {{ post.id }}
                <test text="CLick ne" ></test>
            </h2>
        </template>

        <h1>MARE</h1>
    </AppLayout>
</template>
