<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    name: "Posts",
    components: {
        AppLayout,
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
        <div v-for="post in posts" class="mt-5 grid grid-cols-1 place-items-center" >
            <div v-if="post.text">
                <h1 class="text-blue-300">{{ post.text }}</h1>
            </div>
            <div v-else-if="post.image">
                <img :src="'storage/'+post.image" alt="">
            </div>
            <div v-else>
                <video :src="'storage/'+post.video"></video>
            </div>
        </div>
    </AppLayout>
</template>
