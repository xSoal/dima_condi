<template>
    <div class="fileElement" :style="`background-image: url(${url})`">
        <div class="icon" @click="deleteHandler">
            <a-icon type="delete" />
        </div>
        <div class="fileName">
            {{fileName}}
        </div>
        <a-modal
            title="Подтверждение удаления"
            :visible="deleteModalVisible"
            @ok="deleteOk"
            @cancel="deleteCancel"
        >
            <div class="modalInner">
                <p> Удалить эту картинку??? </p>
                <div class="fileElement full" :style="`background-image: url(${url})`">
                    <div class="fileName">
                        {{fileName}}
                    </div>
                </div>
            </div>

        </a-modal>
    </div>
</template>

<script>
    export default {
        name: "FileElement",
        props: ["path", "id"],
        data(){
            const p = this.path.split("/");
            const fileName = p[p.length - 1];
            return {
                url: this.path,
                fileName,
                deleteModalVisible: false,
            }
        },
        methods: {
            deleteHandler(){
                this.deleteModalVisible = true;
            },
            async deleteOk(){
                this.$emit('remove', this.id);
                this.deleteModalVisible = false;
            },
            deleteCancel(){
                this.deleteModalVisible = false;
            }
        }
    }
</script>

<style scoped>
    .fileElement {
        margin: 15px;
        width: 150px;
        height: 150px;
        position: relative;
        border-radius: 4px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.14);
        padding: 3px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .fileElement.full {
        width: 360px;
        height: 360px;
        margin: auto;
    }

    .fileName {
        color: #777;
        font-size: 8px;
        overflow: hidden;
    }

    .icon {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(231, 231, 231, 0.16);
        border-radius: 4px;
        padding: 4px;
        cursor: pointer;
        width: 25px;
        height: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modalInner {
        text-align: center;
    }
</style>
