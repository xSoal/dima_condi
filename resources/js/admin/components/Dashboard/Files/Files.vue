<template>
    <div>
        <!--        <div>-->
        <!--            <form @submit.prevent="submit">-->
        <!--                <div class="form-group">-->
        <!--                    <div class="custom-file">-->
        <!--                        <input type="file"-->
        <!--                               class="custom-file-input"-->
        <!--                               id="customFile"-->
        <!--                               @change="onAttachmentChange"-->
        <!--                        >-->
        <!--                        <label class="custom-file-label" for="customFile">Choose file</label>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <button type="submit" class="btn btn-primary">Submit</button>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <hr>

        <div>
            <div>
                <a-upload
                    action="/api/images"
                    @change="fileLoadStatus"
                >
                    <a-button>
                        <a-icon type="upload"/>
                        upload
                    </a-button>
                </a-upload>
            </div>
            <div v-if="fileList.length" class="fileElement__cont">
                <FileElement
                    v-for="file in fileList"
                    :key="file.id"
                    :path="file.path"
                    :id="file.id"
                    @remove="remove"
                />
            </div>
        </div>
        <FilePicker/>
    </div>
</template>

<script>
    import axios from 'axios';
    import FileElement from "./FileElement";
    import { mapActions } from 'vuex';
    import FilePicker from "../../../reusable_components/FilePicker/FilePicker";


    export default {
        name: "Files",
        components: {FilePicker, FileElement},
        data() {
            return {
                name: null,
                attachment: null,
                fileList: []
            }
        },
        methods: {
            ...mapActions([
                "loadFileList"
            ]),
            async fileLoadStatus(info) {
                const status = info.file.status;
                if (status === 'error') {
                    // show error message
                    this.$notification['error']({
                        message: info.file.response.errors.file
                    })
                } else if (status === 'done'){
                    this.$notification['success']({
                        message: "Файл загружен"
                    });

                    this.fileList = await this.loadFileList();

                }
            },
            async remove( fileId ) {

                try{
                    const req = await this.$API.delete(`/images/${fileId}`);

                    if(!req.error){
                        this.$notification["success"]({
                            message: "Файл удален"
                        });

                        this.fileList = await this.loadFileList();

                    } else {
                        this.$notification["error"]({
                            message: req.response.data.error
                        });
                    }

                } catch(error){
                    this.$notification["error"]({
                        message: "Ошибка при удалении"
                    });
                }


            },
            onAttachmentChange(e) {
                this.attachment = e.target.files[0]
            }
        },
        async mounted() {
            this.fileList = await this.loadFileList();

        }
    }
</script>

<style scoped>

    .fileElement__cont {
        display: flex;
        flex-wrap: wrap;
    }

</style>
