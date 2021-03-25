<template>
    <div class="filePicker__fileCont">
        <div class="filePicker__file" :class="isSelected ? 'selected' : '' ">
            <img :src="data.path" alt="" class="filePicker__fileImage">
        </div>
    </div>

</template>

<script>
    export default {
        name: "File",
        props: [
            "data",
            "isSelected"
        ],
    }
</script>

<style scoped>
    .filePicker__fileCont {
        width: 15%;
        max-width: 250px;
    }

    .filePicker__file {
        padding-bottom: 100%;
        position: relative;
        border-radius: 10px;
        border: 1px solid #ffffff;
        box-shadow: 0px 0px 14px #c7c7c7;
        overflow: hidden;
        background-color: transparent;
        transition: .25s;
    }

    .filePicker__file:hover {
        border-color: #3dab4c;
        box-shadow: 0px 0px 17px #b1b1b1;
    }

    .filePicker__file:hover img {
        opacity: .9;
    }

    .filePicker__file img {

        max-width: 100%;
        width: auto;
        max-height: 100%;
        height: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;

        cursor: pointer;
        transition: .25s;


    }


    .selected {
        border: 3px  solid green;
    }
</style>
