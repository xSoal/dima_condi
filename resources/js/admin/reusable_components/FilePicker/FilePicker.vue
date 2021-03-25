<template>
    <div
        class="filePicker__cont"
        ref="cont"
    >
        <div class="filePicker">
            <div class="filePicker__currentFile">
                <div class="filePicker__currentFileImage"  @click="choseFile">
                    <img
                        v-if="currentFileSrc"
                         :src="`${currentFileSrc}`"
                    >
                    <div v-else-if="!currentFileSrc && !loading" class="filePicker__nothing">
                        Nothing select
                    </div>
                    <Loader v-if="loading"/>
                </div>
            </div>
        </div>
        <FileList
            ref="fileList"
            :is-open="isOpen"
            @close="isOpen = false"
            :files="files"
            @selectFile="selectFileHandler"
            :currentFileSrc="value"
        />
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import Loader from "../Loader";
    import FileList from "./FileList";

    export default {
        name: "FilePicker",
        props: [
            "value",
            "currentFileSrcProps",
            "selectFileHandlerProps"
        ],
        components: {FileList, Loader},
        data() {
            return {
                currentFileSrc: this.currentFileSrcProps && this.currentFileSrcProps !== '' ? this.currentFileSrcProps : false,
                loading: false,
                isOpen: false,
                files: [],
            }
        },
        methods: {
            ...mapActions([
                'loadFileList'
            ]),
            async choseFile() {
                this.loading = true;

                this.files = await this.loadFileList();
                this.loading = false;
                this.isOpen = true;
            },
            selectFileHandler(imgSrc){
                this.currentFileSrc = imgSrc;
                this.$emit('input', imgSrc);

                if(this.selectFileHandlerProps){
                    this.selectFileHandlerProps(imgSrc);
                }

            }

        },
        mounted() {

        }
    }
</script>

<style scoped>
    .filePicker__currentFile {
        width: 150px;
        height: 150px;
        position: relative;
        border: 1px solid #e7e7e7;
        border-radius: 4px;
        cursor: pointer;
        transition: .25s;

    }

    .filePicker__currentFile:hover {
        opacity: .9;
        border-color: #2d3748;
    }

    .filePicker__currentFileImage > * {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;

    }

    .filePicker__nothing {

    }

    .filePicker__currentFileImage img {
        max-width: 100%;
        max-height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }


</style>
