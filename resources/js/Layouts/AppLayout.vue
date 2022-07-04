<script setup>
import {ref} from 'vue';
import {Inertia} from '@inertiajs/inertia';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {PlusIcon} from '@heroicons/vue/solid'
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
    })
    console.log(searchField.value)
}, 1200)

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
    <!--    <div>-->
    <!--        <Head :title="title" />-->

    <!--        <JetBanner />-->

    <!--        <div class="min-h-screen bg-gray-100">-->
    <!--            <nav class="bg-white border-b border-gray-100">-->
    <!--                &lt;!&ndash; Primary Navigation Menu &ndash;&gt;-->
    <!--                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">-->
    <!--                    <div class="flex justify-between h-16">-->
    <!--                        <div class="flex">-->
    <!--                            &lt;!&ndash; Logo &ndash;&gt;-->
    <!--                            <div class="shrink-0 flex items-center">-->
    <!--                                <Link :href="route('dashboard')">-->
    <!--                                    <JetApplicationMark class="block h-9 w-auto" />-->
    <!--                                </Link>-->
    <!--                            </div>-->

    <!--                            &lt;!&ndash; Navigation Links &ndash;&gt;-->
    <!--                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">-->
    <!--                                <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
    <!--                                    Dashboard-->
    <!--                                </JetNavLink>-->
    <!--                                  <JetNavLink :href="route('about')" :active="route().current('about')">-->
    <!--                                    Dashboard2-->
    <!--                                </JetNavLink>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="hidden sm:flex sm:items-center sm:ml-6">-->
    <!--                            <div class="ml-3 relative">-->
    <!--                                &lt;!&ndash; Teams Dropdown &ndash;&gt;-->
    <!--                                <JetDropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">-->
    <!--                                    <template #trigger>-->
    <!--                                        <span class="inline-flex rounded-md">-->
    <!--                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">-->
    <!--                                                {{ $page.props.user.current_team.name }}-->

    <!--                                                <svg-->
    <!--                                                    class="ml-2 -mr-0.5 h-4 w-4"-->
    <!--                                                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                                                    viewBox="0 0 20 20"-->
    <!--                                                    fill="currentColor"-->
    <!--                                                >-->
    <!--                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />-->
    <!--                                                </svg>-->
    <!--                                            </button>-->
    <!--                                        </span>-->
    <!--                                    </template>-->

    <!--                                    <template #content>-->
    <!--                                        <div class="w-60">-->
    <!--                                            &lt;!&ndash; Team Management &ndash;&gt;-->
    <!--                                            <template v-if="$page.props.jetstream.hasTeamFeatures">-->
    <!--                                                <div class="block px-4 py-2 text-xs text-gray-400">-->
    <!--                                                    Manage Team-->
    <!--                                                </div>-->

    <!--                                                &lt;!&ndash; Team Settings &ndash;&gt;-->
    <!--                                                <JetDropdownLink :href="route('teams.show', $page.props.user.current_team)">-->
    <!--                                                    Team Settings-->
    <!--                                                </JetDropdownLink>-->

    <!--                                                <JetDropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">-->
    <!--                                                    Create New Team-->
    <!--                                                </JetDropdownLink>-->

    <!--                                                <div class="border-t border-gray-100" />-->

    <!--                                                &lt;!&ndash; Team Switcher &ndash;&gt;-->
    <!--                                                <div class="block px-4 py-2 text-xs text-gray-400">-->
    <!--                                                    Switch Teams-->
    <!--                                                </div>-->

    <!--                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">-->
    <!--                                                    <form @submit.prevent="switchToTeam(team)">-->
    <!--                                                        <JetDropdownLink as="button">-->
    <!--                                                            <div class="flex items-center">-->
    <!--                                                                <svg-->
    <!--                                                                    v-if="team.id == $page.props.user.current_team_id"-->
    <!--                                                                    class="mr-2 h-5 w-5 text-green-400"-->
    <!--                                                                    fill="none"-->
    <!--                                                                    stroke-linecap="round"-->
    <!--                                                                    stroke-linejoin="round"-->
    <!--                                                                    stroke-width="2"-->
    <!--                                                                    stroke="currentColor"-->
    <!--                                                                    viewBox="0 0 24 24"-->
    <!--                                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>-->
    <!--                                                                <div>{{ team.name }}</div>-->
    <!--                                                            </div>-->
    <!--                                                        </JetDropdownLink>-->
    <!--                                                    </form>-->
    <!--                                                </template>-->
    <!--                                            </template>-->
    <!--                                        </div>-->
    <!--                                    </template>-->
    <!--                                </JetDropdown>-->
    <!--                            </div>-->

    <!--                            &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
    <!--                            <div class="ml-3 relative">-->
    <!--                                <JetDropdown align="right" width="48">-->
    <!--                                    <template #trigger>-->
    <!--                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">-->
    <!--                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">-->
    <!--                                        </button>-->

    <!--                                        <span v-else class="inline-flex rounded-md">-->
    <!--                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">-->
    <!--                                                {{ $page.props.user.name }}-->

    <!--                                                <svg-->
    <!--                                                    class="ml-2 -mr-0.5 h-4 w-4"-->
    <!--                                                    xmlns="http://www.w3.org/2000/svg"-->
    <!--                                                    viewBox="0 0 20 20"-->
    <!--                                                    fill="currentColor"-->
    <!--                                                >-->
    <!--                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />-->
    <!--                                                </svg>-->
    <!--                                            </button>-->
    <!--                                        </span>-->
    <!--                                    </template>-->

    <!--                                    <template #content>-->
    <!--                                        &lt;!&ndash; Account Management &ndash;&gt;-->
    <!--                                        <div class="block px-4 py-2 text-xs text-gray-400">-->
    <!--                                            Manage Account-->
    <!--                                        </div>-->

    <!--                                        <JetDropdownLink :href="route('profile.show')">-->
    <!--                                            Profile-->
    <!--                                        </JetDropdownLink>-->

    <!--                                        <JetDropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">-->
    <!--                                            API Tokens-->
    <!--                                        </JetDropdownLink>-->

    <!--                                        <div class="border-t border-gray-100" />-->

    <!--                                        &lt;!&ndash; Authentication &ndash;&gt;-->
    <!--                                        <form @submit.prevent="logout">-->
    <!--                                            <JetDropdownLink as="button">-->
    <!--                                                Log Out-->
    <!--                                            </JetDropdownLink>-->
    <!--                                        </form>-->
    <!--                                    </template>-->
    <!--                                </JetDropdown>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        &lt;!&ndash; Hamburger &ndash;&gt;-->
    <!--                        <div class="-mr-2 flex items-center sm:hidden">-->
    <!--                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" @click="showingNavigationDropdown = ! showingNavigationDropdown">-->
    <!--                                <svg-->
    <!--                                    class="h-6 w-6"-->
    <!--                                    stroke="currentColor"-->
    <!--                                    fill="none"-->
    <!--                                    viewBox="0 0 24 24"-->
    <!--                                >-->
    <!--                                    <path-->
    <!--                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"-->
    <!--                                        stroke-linecap="round"-->
    <!--                                        stroke-linejoin="round"-->
    <!--                                        stroke-width="2"-->
    <!--                                        d="M4 6h16M4 12h16M4 18h16"-->
    <!--                                    />-->
    <!--                                    <path-->
    <!--                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"-->
    <!--                                        stroke-linecap="round"-->
    <!--                                        stroke-linejoin="round"-->
    <!--                                        stroke-width="2"-->
    <!--                                        d="M6 18L18 6M6 6l12 12"-->
    <!--                                    />-->
    <!--                                </svg>-->
    <!--                            </button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->

    <!--                &lt;!&ndash; Responsive Navigation Menu &ndash;&gt;-->
    <!--                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">-->
    <!--                    <div class="pt-2 pb-3 space-y-1">-->
    <!--                        <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
    <!--                            Dashboard-->
    <!--                        </JetResponsiveNavLink>-->
    <!--                    </div>-->

    <!--                    &lt;!&ndash; Responsive Settings Options &ndash;&gt;-->
    <!--                    <div class="pt-4 pb-1 border-t border-gray-200">-->
    <!--                        <div class="flex items-center px-4">-->
    <!--                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">-->
    <!--                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">-->
    <!--                            </div>-->

    <!--                            <div>-->
    <!--                                <div class="font-medium text-base text-gray-800">-->
    <!--                                    {{ $page.props.user.name }}-->
    <!--                                </div>-->
    <!--                                <div class="font-medium text-sm text-gray-500">-->
    <!--                                    {{ $page.props.user.email }}-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                        <div class="mt-3 space-y-1">-->
    <!--                            <JetResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">-->
    <!--                                Profile-->
    <!--                            </JetResponsiveNavLink>-->

    <!--                            <JetResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">-->
    <!--                                API Tokens-->
    <!--                            </JetResponsiveNavLink>-->

    <!--                            &lt;!&ndash; Authentication &ndash;&gt;-->
    <!--                            <form method="POST" @submit.prevent="logout">-->
    <!--                                <JetResponsiveNavLink as="button">-->
    <!--                                    Log Out-->
    <!--                                </JetResponsiveNavLink>-->
    <!--                            </form>-->

    <!--                            &lt;!&ndash; Team Management &ndash;&gt;-->
    <!--                            <template v-if="$page.props.jetstream.hasTeamFeatures">-->
    <!--                                <div class="border-t border-gray-200" />-->

    <!--                                <div class="block px-4 py-2 text-xs text-gray-400">-->
    <!--                                    Manage Team-->
    <!--                                </div>-->

    <!--                                &lt;!&ndash; Team Settings &ndash;&gt;-->
    <!--                                <JetResponsiveNavLink :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">-->
    <!--                                    Team Settings-->
    <!--                                </JetResponsiveNavLink>-->

    <!--                                <JetResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')" :active="route().current('teams.create')">-->
    <!--                                    Create New Team-->
    <!--                                </JetResponsiveNavLink>-->

    <!--                                <div class="border-t border-gray-200" />-->

    <!--                                &lt;!&ndash; Team Switcher &ndash;&gt;-->
    <!--                                <div class="block px-4 py-2 text-xs text-gray-400">-->
    <!--                                    Switch Teams-->
    <!--                                </div>-->

    <!--                                <template v-for="team in $page.props.user.all_teams" :key="team.id">-->
    <!--                                    <form @submit.prevent="switchToTeam(team)">-->
    <!--                                        <JetResponsiveNavLink as="button">-->
    <!--                                            <div class="flex items-center">-->
    <!--                                                <svg-->
    <!--                                                    v-if="team.id == $page.props.user.current_team_id"-->
    <!--                                                    class="mr-2 h-5 w-5 text-green-400"-->
    <!--                                                    fill="none"-->
    <!--                                                    stroke-linecap="round"-->
    <!--                                                    stroke-linejoin="round"-->
    <!--                                                    stroke-width="2"-->
    <!--                                                    stroke="currentColor"-->
    <!--                                                    viewBox="0 0 24 24"-->
    <!--                                                ><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>-->
    <!--                                                <div>{{ team.name }}</div>-->
    <!--                                            </div>-->
    <!--                                        </JetResponsiveNavLink>-->
    <!--                                    </form>-->
    <!--                                </template>-->
    <!--                            </template>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </nav>-->

    <!--            &lt;!&ndash; Page Heading &ndash;&gt;-->
    <!--            <header v-if="$slots.header" class="bg-white shadow">-->
    <!--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">-->
    <!--                    <slot name="header" />-->
    <!--                </div>-->
    <!--            </header>-->

    <!--            &lt;!&ndash; Page Content &ndash;&gt;-->
    <!--            <main>-->
    <!--                <slot />-->
    <!--            </main>-->
    <!--        </div>-->
    <!--    </div>-->
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
                <div v-if="searchData.length > 0" class="absolute left-0 mt-3 w-full bg-white rounded bg-gray-800 px-3">
                    <Link v-for="user in searchData" class="mt-2 flex" :href="route('users.show', {user:user.id})">
                        <img :src="user.profile_photo_url" alt="" class="h-10 w-10 rounded-full">
                        <div class="ml-3">
                            <p class="font-semibold">@{{ user.username }}</p>
                            <p>{{user.name}}</p>
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
                                                                    <label class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500"
                                                                           for="file-upload">
                                                                        <span>Upload a file</span>
                                                                        <input id="file-upload" ref="media"
                                                                               accept=".mp4,.png,.jpg,.jpeg" class="sr-only"
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
