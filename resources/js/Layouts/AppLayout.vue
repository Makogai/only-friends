<script setup>
import {ref} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {PlusIcon, XCircleIcon, XIcon} from '@heroicons/vue/solid'
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
                    <div v-if="searchData.length == 0" class="pa-3 text-center flex flex-row justify-center items-center gap-2">
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

                <img alt="" src="@img/logo.png">
            </Link>
        </div>
        <div class=" grid grid-cols-5 place-content-center">
            <div>😊</div>
            <div>😍</div>
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
                                class="absolute mt-2 w-56 origin-top divide-y divide-gray-100 rounded-md bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none p-4"
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
            <div>🤡</div>
            <div>😋</div>
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

    <main class="max-w-5xl mx-auto w-full">
        <slot/>
    </main>

</template>
