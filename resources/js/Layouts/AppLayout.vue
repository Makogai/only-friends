<script setup>
import {ref} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {PlusIcon, XCircleIcon, XIcon, LogoutIcon} from '@heroicons/vue/solid'
import {debounce} from "lodash";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

defineProps({
    title: String,
});

const isOpen = ref(false)
const isOpen2 = ref(false)

function closeModal() {
    isOpen.value = false
    isOpen2.value = false
}

function openModal(type) {
    if (type === 1)
        isOpen.value = true
    else
        isOpen2.value = true
}

let textPostForm = useForm({
    text: ''
})

let searchModal = ref(false);

const submitTextForm = () => {
    textPostForm.post(route('post.text'), {
        onSuccess: () => {
            isOpen.value = false;
        }
    });
}

let mediaPostForm = useForm({
    media: null
})
const media = ref(null);
const submitMediaForm = () => {
    if (media.value) {
        mediaPostForm.media = media.value.files[0];
    }
    mediaPostForm.post(route('post.media'), {
        onSuccess: () => {
            isOpen2.value = false;
        }
    })
}
let mediaUrl = ref()
const previewImage = (e) => {
    const file = e.target.files[0];
    mediaUrl.value = URL.createObjectURL(file);
}
const showingNavigationDropdown = ref(false);

let searchField = ref();
let searchData = ref([])

const search = debounce((val) => {

    axios.get(route('user.search'), {
        params: {
            term: searchField.value
        }
    }).then(res => {
        searchData.value = res.data;
        searchModal.value = true
    })
    console.log(searchField.value)
}, 1)

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div class="grid grid-cols-3 bg-black py-5 gap-24 place-content-center max-w-6xl mb-6 mx-auto">
        <div class="flex items-center">
            <div class="relative text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button class="p-1 focus:outline-none focus:shadow-outline" type="submit">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-linecap="round"
                             stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"><path
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </span>
                <input v-model="searchField"
                       autocomplete="off"
                       class="py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none "
                       name="q"
                       placeholder="Search..."
                       type="search" @input="search">
                <div v-if="searchModal" class="absolute left-0 mt-3 w-full bg-white rounded bg-gray-800 px-3 pb-3">
                    <div class="flex justify-end">

                        <XCircleIcon class="h-5 w-5 text-white mt-2 cursor-pointer"
                                     @click="searchModal = false"></XCircleIcon>
                    </div>
                    <div v-if="searchData.length === 0"
                         class="pa-3 text-center flex flex-row justify-center items-center gap-2">
                        <XIcon class="h-6 w-6 text-gray-200"></XIcon>
                        No search results
                    </div>
                    <Link v-for="user in searchData" :href="route('users.show', {user:user.id})" class="mt-2 flex">
                        <img :src="user.profile_photo_url" alt="" class="h-10 w-10 rounded-full">
                        <div class="ml-3">
                            <p class="font-semibold">@{{ user.username }}</p>
                            <p>{{ user.name }}</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
        <div class="">
            <Link href="/">

                <img alt="" src="@img/logo1.png">
            </Link>
        </div>
        <div class=" grid grid-cols-5 place-content-center">
            <div>
                <Link :href="route('dashboard')">
                    <svg fill="none" height="19" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            :fill="route().current() == 'dashboard' ? 'white' : 'transparent'"
                            d="M4.5 5c1.461-1.461 3.094-2.581 4.198-3.26a2.474 2.474 0 0 1 2.605 0C12.406 2.42 14.039 3.54 15.5 5c3.169 3.168 3 5 3 8 0 1.41-.11 2.599-.227 3.463-.124.91-.917 1.537-1.834 1.537H15a2 2 0 0 1-2-2v-2a3 3 0 0 0-6 0v2a2 2 0 0 1-2 2H3.562c-.918 0-1.711-.627-1.834-1.537A25.995 25.995 0 0 1 1.5 13c0-3-.168-4.832 3-8Z"/>
                        <path
                            d="m12.121 11.879.53-.53-.53.53ZM1.501 13H.75h.75Zm.227 3.463.743-.1-.743.1Zm16.545 0-.744-.1.744.1ZM8.698 1.741l.392.639-.392-.64Zm2.605 0 .392-.64-.392.64Zm5.136 15.509H15v1.5h1.439v-1.5ZM13.75 16v-2h-1.5v2h1.5Zm0-2a3.75 3.75 0 0 0-1.098-2.652l-1.06 1.061c.421.422.658.994.658 1.591h1.5Zm-1.098-2.652A3.75 3.75 0 0 0 10 10.25v1.5a2.25 2.25 0 0 1 1.591.659l1.06-1.06ZM10 10.25a3.75 3.75 0 0 0-2.652 1.098L8.41 12.41A2.25 2.25 0 0 1 10 11.75v-1.5Zm-2.652 1.098A3.75 3.75 0 0 0 6.25 14h1.5c0-.597.237-1.169.66-1.591l-1.062-1.06ZM6.25 14v2h1.5v-2h-1.5ZM5 17.25H3.562v1.5H5v-1.5ZM8.305 1.102c-1.131.695-2.817 1.85-4.335 3.368l1.06 1.06c1.405-1.404 2.984-2.489 4.06-3.15l-.785-1.278ZM16.03 4.47c-1.518-1.518-3.204-2.673-4.335-3.368L10.91 2.38c1.077.661 2.655 1.746 4.06 3.15l1.06-1.06ZM2.47 16.363A25.242 25.242 0 0 1 2.25 13H.75c0 1.448.114 2.671.234 3.564l1.487-.201ZM17.75 13c0 1.371-.107 2.526-.22 3.363l1.486.2c.12-.891.234-2.114.234-3.563h-1.5ZM3.97 4.47C2.328 6.11 1.49 7.467 1.09 8.856.701 10.21.751 11.546.751 13h1.5c0-1.546-.036-2.626.282-3.73.308-1.068.97-2.213 2.497-3.74L3.97 4.47ZM19.25 13c0-1.454.05-2.79-.341-4.144-.4-1.39-1.237-2.745-2.879-4.386l-1.06 1.06c1.527 1.527 2.19 2.672 2.498 3.74.317 1.104.282 2.184.282 3.73h1.5ZM3.562 17.25c-.582 0-1.023-.387-1.091-.887l-1.487.2c.179 1.32 1.324 2.187 2.578 2.187v-1.5ZM6.25 16c0 .69-.56 1.25-1.25 1.25v1.5A2.75 2.75 0 0 0 7.75 16h-1.5ZM15 17.25c-.69 0-1.25-.56-1.25-1.25h-1.5A2.75 2.75 0 0 0 15 18.75v-1.5Zm1.439 1.5c1.253 0 2.398-.867 2.577-2.186l-1.487-.201c-.067.5-.509.887-1.09.887v1.5ZM9.09 2.38a1.724 1.724 0 0 1 1.82 0l.785-1.278a3.224 3.224 0 0 0-3.39 0L9.09 2.38Z"
                            fill="#fff"/>
                    </svg>
                </Link>
            </div>
            <div>
                <Link href="/chat">

                    <svg fill="none" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 1C3.118 1 1 2.647 1 8c0 3.738 1.033 5.67 4 6.494V19l4.012-4.012c.318.008.647.012.988.012 6.882 0 9-1.647 9-7s-2.118-7-9-7Z"
                            fill="transparent"/>
                        <path
                            d="M6 5.25a.75.75 0 0 0 0 1.5v-1.5Zm8 1.5a.75.75 0 0 0 0-1.5v1.5Zm-8 2.5a.75.75 0 0 0 0 1.5v-1.5Zm5 1.5a.75.75 0 0 0 0-1.5v1.5Zm-6 3.744h.75a.75.75 0 0 0-.55-.723l-.2.723Zm4.012.494.02-.75a.75.75 0 0 0-.55.22l.53.53ZM5 19h-.75a.75.75 0 0 0 1.28.53L5 19ZM6 6.75h8v-1.5H6v1.5Zm0 4h5v-1.5H6v1.5ZM1.75 8c0-2.608.521-4.053 1.63-4.915C4.55 2.174 6.564 1.75 10 1.75V.25c-3.446 0-5.933.4-7.541 1.65C.788 3.2.25 5.256.25 8h1.5Zm16.5 0c0 2.608-.521 4.053-1.63 4.915-1.17.911-3.184 1.335-6.62 1.335v1.5c3.446 0 5.933-.4 7.541-1.65 1.671-1.3 2.209-3.355 2.209-6.1h-1.5ZM10 1.75c3.436 0 5.45.424 6.62 1.335 1.109.862 1.63 2.307 1.63 4.915h1.5c0-2.745-.538-4.8-2.209-6.1C15.933.65 13.446.25 10 .25v1.5ZM5.2 13.771c-1.349-.375-2.163-.97-2.669-1.816-.526-.88-.781-2.136-.781-3.955H.25c0 1.92.261 3.499.993 4.724.753 1.26 1.938 2.043 3.556 2.492l.402-1.445Zm4.8.479c-.335 0-.657-.004-.968-.012l-.04 1.5c.326.008.661.012 1.008.012v-1.5Zm-5.75.244V19h1.5v-4.506h-1.5Zm1.28 5.036 4.013-4.012-1.061-1.06L4.47 18.47l1.06 1.06Z"
                            fill="#00ADEA"/>
                    </svg>
                </Link>
            </div>
            <div>
                <div class="cursor-pointer relative">
                    <div class="">
                        <Menu as="div" class="t">
                            <div>
                                <MenuButton
                                    class=""
                                >
                                    <PlusIcon class="text-white w-6 h-6"></PlusIcon>
                                </MenuButton>
                            </div>

                            <transition
                                enter-active-class="transition duration-100 ease-out"
                                enter-from-class="transform scale-95 opacity-0"
                                enter-to-class="transform scale-100 opacity-100"
                                leave-active-class="transition duration-75 ease-in"
                                leave-from-class="transform scale-100 opacity-100"
                                leave-to-class="transform scale-95 opacity-0"
                            >
                                <MenuItems
                                    class="absolute mt-2 w-56 origin-top divide-y divide-gray-100 rounded-md bg-gray-800 				shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none p-4"
                                    style="right: 50%; transform: translateX(50%)">
                                    <div class="grid grid-cols-2 place-items-center text-gray-100">
                                        <div class="bg-primary" @click="openModal(1)">TEXT</div>
                                        <div class="bg-secondary" @click="openModal(2)">MEDIA</div>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
            <div>
                <Link :href="route('users.me')">
                    <img :src="$page.props.user.profile_photo_url" class="w-6 h-6 rounded-full" alt="">
                </Link>
            </div>
            <div>
                <LogoutIcon class="text-white cursor-pointer h-5 w-5" @click="logout"></LogoutIcon>
            </div>
            <div>
                <div class="avatar chatify-d-flex h-[20px] w-[20px] items-start"
                     style="background-image: url('http://localhost/storage/users-avatar/http://localhost/storage/users-avatar/avatar.png');">
                </div>
            </div>
        </div>


        <TransitionRoot :show="isOpen" appear as="template">
            <Dialog as="div" class="relative z-10" @close="closeModal">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25"/>
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-xl transform overflow-hidden rounded-2xl bg-gray-800 p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-200 mb-6"
                                >
                                    Add text post
                                </DialogTitle>
                                <div>
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <img :src="$page.props.user.profile_photo_url"
                                                 alt=""
                                                 class="inline-block h-10 w-10 rounded-full">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <form class="relative" @submit.prevent="submitTextForm">
                                                <div
                                                    class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                                    <label class="sr-only" for="comment">Add your comment</label>
                                                    <textarea id="comment" v-model="textPostForm.text"
                                                              class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm"
                                                              name="comment"
                                                              placeholder="Add your comment..."
                                                              rows="3"></textarea>

                                                    <!-- Spacer element to match the height of the toolbar -->
                                                    <div aria-hidden="true" class="py-2">
                                                        <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                                        <div class="py-px">
                                                            <div class="h-9"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                                                    <div></div>
                                                    <div class="flex-shrink-0">
                                                        <button
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                            type="submit">
                                                            Post
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
        <TransitionRoot :show="isOpen2" appear as="template">
            <Dialog as="div" class="relative z-10" @close="closeModal">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-50"/>
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div
                        class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel
                                class="w-full max-w-xl transform overflow-hidden rounded-2xl bg-gray-800 p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-200 mb-6"
                                >
                                    Add text post
                                </DialogTitle>
                                <div>
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0">
                                            <img :src="$page.props.user.profile_photo_url"
                                                 alt=""
                                                 class="inline-block h-10 w-10 rounded-full">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <form class="relative" @submit.prevent="submitMediaForm">
                                                <div
                                                    class="sm:grid sm:grid-cols-1 sm:gap-4 sm:items-start sm:border-gray-200 sm:pt-5">
                                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                        <div
                                                            class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                            <div class="space-y-1 text-center">
                                                                <svg aria-hidden="true"
                                                                     class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 48 48">
                                                                    <path
                                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"/>
                                                                </svg>
                                                                <div class="flex text-sm text-gray-600">
                                                                    <label
                                                                        class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                                                        for="file-upload">
                                                                        <span>Upload a file</span>
                                                                        <input id="file-upload" ref="media"
                                                                               accept=".mp4,.png,.jpg,.jpeg"
                                                                               class="sr-only"
                                                                               name="file-upload" type="file"
                                                                               @change="previewImage">
                                                                    </label>
                                                                    <p class="pl-1">or drag and drop</p>
                                                                </div>
                                                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to
                                                                    10MB</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                                                    <div></div>
                                                    <div class="flex-shrink-0">
                                                        <button
                                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                            type="submit">
                                                            Post
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>


    </div>

    <main class="max-w-6xl mx-auto w-full">
        <slot/>
    </main>

</template>
