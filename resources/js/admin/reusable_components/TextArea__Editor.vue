<template>
    <div class="editor">
        <wysiwyg
            class="textarea__editor"
            v-model="content"
            @change="$emit('input', content)"
        />
    </div>
</template>

<script>

    import "vue-wysiwyg/dist/vueWysiwyg.css";

    export default {
        name: "TextArea__Editor",
        props: ["value"],
        components: {
        },
        data() {
            return {
                content: this.value,
            }
        },
        methods: {

        },

        watch: {
            value(newData){
                this.content = newData;
            }
        }

    }
</script>

<style scoped>
    .textarea__editor {
        margin: 15px auto;
    }
</style>
