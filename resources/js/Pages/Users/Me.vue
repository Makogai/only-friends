<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {useForm, Link} from "@inertiajs/inertia-vue3";

export default {
    name: "User",
    components: {
        AppLayout,
        Link
    },
    props: {
        user: {
            type: Object,
            default: [],
        },
        friendsCount: {
            type: Number
        },
    },
    setup(props) {
        let addForm = useForm({
            user_id: props.user.id
        })
        const addFriend = (user_id) => {
            addForm.post(route('users.add'), {
                onSuccess: () => {
                    console.log("ADDED")
                }
            })
        }
        return {
            addFriend
        };
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>

        </template>

        <div class="max-w-6xl mx-auto flex mt-20 border-b-gray-600 border-b pb-14">
            <div class="pl-16">
                <img alt=""
                     class="rounded-full w-48 h-48 inline-block"
                     :src="user.profile_photo_url">
            </div>
            <div class="text-white">
                <p class="inline-block pl-14 text-[28px]">{{user.name}}</p>
                <p class="pl-14 text-[20px] text-gray-600 mt-2">@{{user.username}}</p>
                <div class="inline-block">
                    <p class="pl-14 pt-10">{{ friendsCount }}</p>
                    <p class="pl-14 text-gray-600">Friends</p>
                </div>
            </div>
            <div class="pl-[350px] ">
                <Link :href="route('profile.show')" class="border-white border text-white text-lg px-4 py-1 rounded-3xl w-auto h-auto">Edit profile</Link>
            </div>
        </div>
        <div class="max-w-6xl mx-auto grid place-items-center text-white mt-20 ">
            <div v-if="user.posts.length > 0" class="grid grid-cols-3 gap-2">
                <div v-for="post in user.posts" class="border">
                    <div v-if="post.image">
                        <img :src="'/storage/'+post.image" alt="" class=" rounded-2xl">
                    </div>
                    <div v-if="post.video">
                        <video :src="'/storage/'+post.video" alt="" class="h-34 w-full rounded-2xl"></video>
                    </div>
                    <div v-else class="grid place-items-center grid-cols-1 h-full">
                        <p class="text-center">
                            {{post.text}}
                        </p>
                    </div>
                </div>
            </div>
            <p v-else>You dont have any posts</p>
        </div>
    </AppLayout>
</template>
