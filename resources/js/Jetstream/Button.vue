<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 text-white bg-indigo-500 border-0 focus:outline-none hover:bg-indigo-600 rounded font-semibold text-xs uppercase tracking-widest focus:shadow-outline-gray disabled:opacity-25 transition">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
