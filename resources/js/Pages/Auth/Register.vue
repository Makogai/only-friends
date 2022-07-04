<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import {ref} from 'vue'
import {
    Listbox,
    ListboxLabel,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

import {CheckIcon, SelectorIcon} from '@heroicons/vue/solid'

const form = useForm({
    name: '',
    email: '',
    password: '',
    username: '',
    password_confirmation: '',
    country_id: null,
    terms: false,
});

const props = defineProps({
    countries: Array
})
const selectedCountry = ref(props.countries[0])

const submit = () => {
    form.country_id = 1
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<!--<template>-->
<!--    <Head title="Register"/>-->

<!--    <JetAuthenticationCard>-->
<!--        <template #logo>-->
<!--            <JetAuthenticationCardLogo/>-->
<!--        </template>-->

<!--        <JetValidationErrors class="mb-4"/>-->

<!--        <form @submit.prevent="submit">-->
<!--            <div>-->
<!--                <JetLabel for="name" value="Name"/>-->
<!--                <JetInput-->
<!--                    id="name"-->
<!--                    v-model="form.name"-->
<!--                    autocomplete="name"-->
<!--                    autofocus-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    type="text"-->
<!--                />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <JetLabel for="email" value="Email"/>-->
<!--                <JetInput-->
<!--                    id="email"-->
<!--                    v-model="form.email"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    type="email"-->
<!--                />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <JetLabel for="username" value="Username"/>-->
<!--                <JetInput-->
<!--                    id="username"-->
<!--                    v-model="form.username"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    type="text"-->
<!--                />-->
<!--            </div>-->

<!--            <Listbox v-model="selectedCountry">-->
<!--                <div class="relative mt-1">-->
<!--                    <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-2 pl-3 pr-10 text-left border border-gray-300  focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">-->
<!--                        <span class="block truncate">{{ selectedCountry.name }}</span>-->
<!--                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">-->
<!--            <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />-->
<!--          </span>-->
<!--                    </ListboxButton>-->

<!--                    <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">-->
<!--                        <ListboxOptions class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">-->
<!--                            <ListboxOption v-slot="{ active, selected }" v-for="country in countries" :key="country.name" :value="country" as="template">-->
<!--                                <li-->
<!--                                    :class="[-->
<!--                  active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',-->
<!--                  'relative cursor-default select-none py-2 pl-10 pr-4',-->
<!--                ]"-->
<!--                                >-->
<!--                <span-->
<!--                    :class="[-->
<!--                    selected ? 'font-medium' : 'font-normal',-->
<!--                    'block truncate',-->
<!--                  ]"-->
<!--                >{{ country.name }}</span-->
<!--                >-->
<!--                                    <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600">-->
<!--                  <CheckIcon class="h-5 w-5" aria-hidden="true" />-->
<!--                </span>-->
<!--                                </li>-->
<!--                            </ListboxOption>-->
<!--                        </ListboxOptions>-->
<!--                    </transition>-->
<!--                </div>-->
<!--            </Listbox>-->


<!--            <div class="mt-4">-->
<!--                <JetLabel for="password" value="Password"/>-->
<!--                <JetInput-->
<!--                    id="password"-->
<!--                    v-model="form.password"-->
<!--                    autocomplete="new-password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    type="password"-->
<!--                />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <JetLabel for="password_confirmation" value="Confirm Password"/>-->
<!--                <JetInput-->
<!--                    id="password_confirmation"-->
<!--                    v-model="form.password_confirmation"-->
<!--                    autocomplete="new-password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    required-->
<!--                    type="password"-->
<!--                />-->
<!--            </div>-->

<!--            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">-->
<!--                <JetLabel for="terms">-->
<!--                    <div class="flex items-center">-->
<!--                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms"/>-->

<!--                        <div class="ml-2">-->
<!--                            I agree to the <a :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900"-->
<!--                                              target="_blank">Terms of-->
<!--                            Service</a> and <a :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900"-->
<!--                                               target="_blank">Privacy-->
<!--                            Policy</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </JetLabel>-->
<!--            </div>-->

<!--            <div class="flex items-center justify-end mt-4">-->
<!--                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
<!--                    Already registered?-->
<!--                </Link>-->

<!--                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-4">-->
<!--                    Register-->
<!--                </JetButton>-->
<!--            </div>-->
<!--        </form>-->
<!--    </JetAuthenticationCard>-->
<!--</template>-->

<style>
img {
    height: 100%;
    /*width: 100%;*/
    object-fit: cover;
}
</style>
<template>
    <div class="grid place-items-center h-screen">
        <div class="bg-[#000016] rounded-l-3xl grid md:grid-cols-2 sm:grid-cols-1 max-w-5xl overflow-hidden">
            <div class="img ">

                <img alt=""
                     class="h-full"
                     src="https://media.discordapp.net/attachments/695948905573253161/985248899352637481/image_7.png?width=1183&height=665">
            </div>
            <div bis_skin_checked="1" class="z-10 relative w-full" style="height: auto;">
                <svg class="-ml-10 absolute" preserveAspectRatio="none" style="height: 100%; width: 100%;"
                     viewBox="0 0 500 150">
                    <path class="fill-[#000016]"
                          d="M15.52,-0.47 C-4.79,78.47 56.15,73.53 17.77,150.50 L500.00,150.00 L500.00,0.00 Z"
                          style="stroke: none;"></path>
                </svg>
                <div class="grid place-items-center py-20 z-20 w-full h-full">
                    <div class="p-5 z-20 w-full px-10">
                        <img alt="" class="mx-auto mb-6 h-24" src="@img/logo1.png">
                        <h3 class="text-4xl my-4 my-4 text-center text-blue-300">Register</h3>
                        <form @submit.prevent="submit">

                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="first-name" v-model="form.name" autocomplete="given-name"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="first-name"
                                       placeholder="Enter your name"
                                       type="text"/>
                            </div>
                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="email" v-model="form.email" autocomplete="email"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="email"
                                       placeholder="Enter your email"
                                       type="email"/>
                            </div>
                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="username" v-model="form.username" autocomplete="username"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="username"
                                       placeholder="Enter your username"
                                       type="text"/>
                            </div>
                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="first-password" v-model="form.password" autocomplete="password"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="password"
                                       placeholder="Enter your password"
                                       type="password"/>
                            </div>
                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="first-password_confirmation" v-model="form.password_confirmation" autocomplete="password_confirmation"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="password_confirmation"
                                       placeholder="Confirm your password"
                                       type="password"/>
                            </div>
                                        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                                            <JetLabel for="terms">
                                                <div class="flex items-center text-blue-300">
                                                    <JetCheckbox id="terms" v-model:checked="form.terms" name="terms"/>

                                                    <div class="ml-2">
                                                        I agree to the <a :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-blue-500"
                                                                          target="_blank">Terms of
                                                        Service</a> and <a :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-blue-500"
                                                                           target="_blank">Privacy
                                                        Policy</a>
                                                    </div>
                                                </div>
                                            </JetLabel>
                                        </div>
                            <JetValidationErrors class="mb-4 mt-4" />
                            <button class="bg-blue-300 text-white px-10 py-2 rounded mt-5 w-full" @click="submit">
                                Register
                            </button>
                            <p class="mt-2 text-white">Already have an account? <Link :href="route('login')" class="text-blue-300 underline">Login here</Link></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    <Head title="Log in" />-->

    <!--    <JetAuthenticationCard>-->
    <!--        <template #logo>-->
    <!--            <JetAuthenticationCardLogo />-->
    <!--        </template>-->

    <!--        <JetValidationErrors class="mb-4" />-->

    <!--        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">-->
    <!--            {{ status }}-->
    <!--        </div>-->

    <!--        <form @submit.prevent="submit">-->
    <!--            <div>-->
    <!--                <JetLabel for="login" value="Email/Username" />-->
    <!--                <JetInput-->
    <!--                    id="login"-->
    <!--                    v-model="form.login"-->
    <!--                    type="login"-->
    <!--                    class="mt-1 block w-full"-->
    <!--                    required-->
    <!--                    autofocus-->
    <!--                />-->
    <!--            </div>-->

    <!--            <div class="mt-4">-->
    <!--                <JetLabel for="password" value="Password" />-->
    <!--                <JetInput-->
    <!--                    id="password"-->
    <!--                    v-model="form.password"-->
    <!--                    type="password"-->
    <!--                    class="mt-1 block w-full"-->
    <!--                    required-->
    <!--                    autocomplete="current-password"-->
    <!--                />-->
    <!--            </div>-->

    <!--            <div class="block mt-4">-->
    <!--                <label class="flex items-center">-->
    <!--                    <JetCheckbox v-model:checked="form.remember" name="remember" />-->
    <!--                    <span class="ml-2 text-sm text-gray-600">Remember me</span>-->
    <!--                </label>-->
    <!--            </div>-->

    <!--            <div class="flex items-center justify-end mt-4">-->
    <!--                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">-->
    <!--                    Forgot your password?-->
    <!--                </Link>-->

    <!--                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
    <!--                    Log in-->
    <!--                </JetButton>-->
    <!--            </div>-->
    <!--        </form>-->
    <!--    </JetAuthenticationCard>-->
</template>
