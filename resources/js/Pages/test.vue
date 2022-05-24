<template>
    <button class="px-4 py-2 shadow rounded bg-blue-500 text-white hover:bg-blue-800 hover:shadow-lg transition"> <i v-if="hasIcon">+</i> {{ text }}</button>
</template>
<script>
export default {
    props: {
        text: {
            type: String,
            default: "Button"
        },
        hasIcon: {
            type: Boolean,
            default: false
        }
    },
    setup() {
        
    },
}
</script>