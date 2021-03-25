<template>
    <a-form-model-item
        :validate-status="localError ? 'error' : '' "
        :help="localError"
    >
        <div>
            <p class="input_header">
                {{placeholder}}
            </p>
            <a-input
                v-model="localValue"

                @input="$emit('input', localValue)"
                :type="type"
            >
                <a-icon slot="prefix" :type="iconType" style="color:rgba(0,0,0,.25)"
                        :validate-status="localError"
                />
            </a-input>
        </div>

    </a-form-model-item>
</template>

<script>
    export default {
        name: "FormInput",
        props: ['error', 'placeholder', 'type', 'iconType',  'value' ],
        data(){
            return {
                localValue : this.value,
                localError: this.error
            }
        },

        computed: {

        },

        watch: {
            value(newData, oldData){
                this.localValue = newData
            },
            error(newData, oldData){
                this.localError = newData
            }
        }
    }
</script>

<style scoped>
    .input_header {
        margin-top: 10px;
        margin-bottom: 5px;
    }
</style>
