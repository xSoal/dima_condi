<template>
    <div class="fileList"
         ref="fileList"
         v-if="isOpen"
    >
        <div class="fileList__contentOverflow">
            <div
                class="fileList__closeButton"
                @click="$emit('close')"
            >
                <a-icon type="close"/>

            </div>
            <div class="fileList__filesCont">
                <File
                    v-for="fileData in files"
                    :key="fileData.id"
                    :data="fileData"
                    @click.native="selectFileHandler(fileData.path)"
                    :isSelected="currentFileSrc === fileData.path"
                />
            </div>

        </div>
    </div>
</template>

<script>

    import File from './File';

    export default {
        name: "FileList",
        components: {
            File
        },
        props: [
            "isOpen",
            "files",
            "currentFileSrc"
        ],
        data() {
            return {
                isMounted: false
            }
        },
        methods: {
            listenKey(e) {
                if (this.isOpen && e.code === 'Escape') {
                    this.$emit('close');
                }
            },
            selectFileHandler(path) {
                this.$emit('selectFile', path);
                this.$emit('close');
            }
        },
        computed: {
            getCcsStyles(){
                // if (!this.isMounted || !this.isOpen) {
                //     return ``;
                // }
                //
                // const ref = this.$refs.fileList;
                //
                // const x = ref.getBoundingClientRect().x;
                // const y = ref.getBoundingClientRect().y;
                // const zIndex = this.isOpen ? 999999 : -999999;
                //
                //
                // const isOpen = this.isOpen ? `
                //         width: 100vw;
                //         height: 100vh;
                //         display: flex;
                //     ` : ``;
                //
                //
                // return `
                //     transform: translate(-${x}px, -${y}px);
                //     z-index: ${zIndex};
                //     width: ${window.innerWidth}px;
                //     height: ${window.innerHeight}px;
                //     flex-wrap: wrap;
                //     justify-content: center;
                //     align-items: center;
                //     ${isOpen}
                // `;
            }
        },
        mounted() {
            this.isMounted = true;
            window.addEventListener('keyup', this.listenKey);

        },
        beforeDestroy() {
            window.removeEventListener('keyup', this.listenKey);
        }
    }
</script>

<style scoped>
    .fileList {
        position: fixed;
        z-index: 10;
        width: 100vw;
        height: 100vh;
        box-sizing: border-box;
        background-color: #efefef;
        overflow-x: hidden;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }


    .fileList__contentOverflow {
        padding: 45px 35px 55px;
        /*position: relative;*/
        /*width: 100vw;*/
        /*height: 100vh;*/
    }


    .fileList__closeButton {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
        transition: .25s ease-in-out;
        border-radius: 50%;
        border: 1px solid transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 4px;
        background-color: rgb(248, 248, 248);
        box-shadow: 0 0 5px rgba(119, 119, 119, 0.27);
    }

    .fileList__closeButton i {
        font-size: .7rem;
        transition: .25s;
    }

    .fileList__closeButton:hover i {
        transform: rotate(360deg);
        opacity: .9;
    }

    .fileList__filesCont {
        display: flex;
        flex-wrap: wrap;
    }

    .fileList__filesCont > div {
        margin: 15px;
    }


</style>
