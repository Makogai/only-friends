<script setup>
import {Link, useForm} from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    login: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<style>
img {
    height: 100%;
    /*width: 100%;*/
    object-fit: cover;
}
</style>
<template>
    <div class="grid place-items-center h-screen">
        <div class="bg-blue-900 rounded-l-3xl grid md:grid-cols-2 sm:grid-cols-1 max-w-5xl overflow-hidden">
            <div class="img ">

                <img alt=""
                     class="h-full"
                     src="https://media.discordapp.net/attachments/695948905573253161/985248899352637481/image_7.png?width=1183&height=665">
            </div>
            <div bis_skin_checked="1" class="z-10 relative w-full" style="height: auto;">
                <svg class="-ml-10 absolute" preserveAspectRatio="none" style="height: 100%; width: 100%;"
                     viewBox="0 0 500 150">
                    <path class="fill-blue-900"
                          d="M15.52,-0.47 C-4.79,78.47 56.15,73.53 17.77,150.50 L500.00,150.00 L500.00,0.00 Z"
                          style="stroke: none;"></path>
                </svg>
                <div class="grid place-items-center py-20 z-20 w-full h-full">
                    <div class="p-5 z-20 w-full px-10">
                        <img alt="" class="mx-auto mb-6 h-24" src="@img/logo1.png">
                        <h3 class="text-4xl my-4 my-4 text-center text-blue-300">Login</h3>
                        <form @submit.prevent="submit">

                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="first-name" v-model="form.login" autocomplete="given-name"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="first-name"
                                       placeholder="Enter your email/username"
                                       type="text"/>
                            </div>
                            <div class="col-span-6 mt-4 sm:col-span-3">
                                <input id="first-name" v-model="form.password" autocomplete="given-name"
                                       class="text-blue-300 placeholder:text-blue-300 w-full bg-transparent border-blue-500 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                       name="first-name"
                                       placeholder="Enter your password"
                                       type="password"/>
                            </div>
                            <button class="bg-blue-300 text-white px-10 py-2 rounded mt-5 w-full" @click="submit">
                                Login
                            </button>
                            <p class="mt-2 text-white">You don't have an account? <Link :href="route('register')" class="text-blue-300 underline">Create one here</Link></p>
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
