<template>
    <input :type="type" :name="id" :id="id" class="block bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" :value="modelValue" @input="push($event.target.value)" @change="push($event.target.value)" ref="input" :placeholder="ph"/>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'text',
            },
            ph: {
                type: String,
                default: '',
            },
            id: {
                type: String,
                default: '',
            },
            modelValue: {

            },
        },
        

        emits: ['update:modelValue'],

        watch: {
            modelValue: function (val) {
                this.push(val)
            }
        },
        
        methods: {
            focus() {
                this.$refs.input.focus()
            },
            
            push(value) {
                this.$emit('update:modelValue', value)
            }
        }
    }
</script>
