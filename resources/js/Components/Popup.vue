<template>
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-white bg-opacity-75 transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="p-4 sm:p-8 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    
                    <slot></slot>

                    <div class="absolute right-4 top-4 cursor-pointer">
                    <div
                    class="border border-indigo-200 bg-white rounded p-1"
                    @click="$emit('close')">
                        ✖
                    </div>
                </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        props: ['',],

        data() {
            return {
            }
        },

        mounted() {
        },

        methods: {
        }
    }
</script>
