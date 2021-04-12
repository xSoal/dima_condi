<template>
    <div
        :class="rootCtrlClass"
    >

        <div class="controls">
            <a-button
                type="primary"

                :disabled=" false "
                @click="addRow"
            >
                Добавить ряд
                <a-icon type="add"/>
            </a-button>
            <a-button
                type="primary"

                :disabled=" false "
                @click="addColumn"
            >
                Добавить столбец
                <a-icon type="add"/>
            </a-button>

            <a-button
                v-if="tdToTransform.length"
                type="primary"

                :disabled=" false "
                @click="mergeTd"
            >
                Обьеденить ячейки
                <a-icon type="add"/>
            </a-button>

            <div class="tableCont">
                <table
                    class="table"
                    v-if="rows">
                    <tr
                        v-for="(row, i) in  rows"
                        :key="i"
                    >
                        <td
                            v-for="(td, i) in row"
                            :key="td.id"
                            @click.ctrl="ctrlDown(td.id)"
                            :class=" tdToTransform.find(el => el === td.id) ? `selected` : `` "
                            :colspan=" td.colspan ? td.colspan : ``  "
                        >
                            <input
                                type="text"
                                v-model="td.text"
                            >
                        </td>

                    </tr>

                </table>
                <div class="deleteCont">
                    <div
                        v-for="(row, i) in rows"
                        @click="deleteRowHandler(i)"
                        class="deleteRow"
                    >

                        <a-icon type="delete"/>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import {mapActions} from "vuex";

    export default {
        name: "Table",
        props: [
            'value'
        ],

        data() {
            return {
                rootCtrlClass: '123',
                tdToTransform: [],
                bodyListenerDown: null,
                bodyListenerUp: null
            }
        },

        computed: {
            rows() {
                return this.value.rows ?? null;
            },

        },
        methods: {
            ...mapActions([
                'editTable'
            ]),

            deleteRowHandler(index) {
                this.value.rows.splice(index, 1);
            },

            addRow() {
                this.value.rows.push(
                    this.value.rows[this.value.rows.length - 1] ?
                        _.cloneDeep(this.value.rows[this.value.rows.length - 1].map(el => ({
                            ...el,
                            id: ++this.value._max_id
                        })))
                        : [{text: 'Текст'}]
                );


                // this.$emit('input', this.value);
            },
            addColumn() {
                // this.value.rows.forEach(row => row.push({
                //     text: 'Текст 1'
                // }));

                this.value.rows = this.value.rows.map(row => [
                    ...row,
                    {text: 'Текст', id: ++this.value._max_id}
                ]);
            },

            ctrlDown(tdId) {
                const index = this.tdToTransform.findIndex(el => el === tdId);
                if (index === -1) {

                    if (this.tdToTransform.length) {
                        const indexRowOfAddingTd = this.value.rows.findIndex(row => row.find(td => td.id === tdId));
                        const indexRowOfExistingToAddingTd = this.value.rows.findIndex(row => row.find(td => td.id === this.tdToTransform[0]));

                        if (indexRowOfAddingTd !== indexRowOfExistingToAddingTd) {
                            this.$notification['error']({
                                message: 'Обьединять можно только ячейки в одном ряду'
                            });
                            return;
                        }
                    }


                    this.tdToTransform.push(tdId)
                } else {
                    this.tdToTransform.splice(index, 1);
                }
            },

            mergeTd() {

                if (this.tdToTransform.length < 2) {
                    return this.$notification['error']({
                        message: 'Обьединять нужно минимум 2 ячейки'
                    })
                }
                const firstId = this.tdToTransform.shift();

                let rowIndex = this.value.rows.findIndex(row => row.find(td => td.id === firstId));
                let indexOfTdToSave = this.value.rows[rowIndex].findIndex(td => td.id === firstId);


                // TODO переделать пьяный код
                let maxColspanLength = 0;
                this.value.rows[0].forEach(td => {
                    let lengthPlus = 1;
                    if (td.colspan) {
                        lengthPlus = td.colspan;
                    }
                    maxColspanLength += lengthPlus;
                });


                this.tdToTransform.forEach(id => {
                    const rowIndex = this.value.rows.findIndex(row => row.find(td => td.id === id));
                    const tdToDeleteIndex = this.value.rows[rowIndex].findIndex(td => td.id === id);

                    this.value.rows[rowIndex].splice(tdToDeleteIndex, 1);
                });


                let newColspanLength = this.tdToTransform.length + 1;

                let sumTdColspanInRow = 0;
                this.value.rows[rowIndex].forEach(td => {
                    sumTdColspanInRow += td.colspan ?? 1;
                });


                // console.log(newColspanLength, sumTdColspanInRow, maxColspanLength)
                //
                // if( newColspanLength + sumTdColspanInRow < maxColspanLength){
                //
                //     newColspanLength = maxColspanLength - sumTdColspanInRow;
                // }


                this.value.rows[rowIndex][indexOfTdToSave].colspan = maxColspanLength - sumTdColspanInRow + 1;


                this.tdToTransform = [];
            }


        },


        watch: {
            value(v) {
                this.value = v;
            }
        },

        mounted() {
            this.bodyListenerDown = window.addEventListener('keydown', function (e) {
                if (e.ctrlKey) {
                    document.getElementsByTagName('body')[0].classList.add('ctrl');
                }
            });

            this.bodyListenerUp = window.addEventListener('keyup', function (e) {

                document.getElementsByTagName('body')[0].classList.remove('ctrl');
            });
        },

        beforeDestroy() {
            window.removeEventListener('keydown', this.bodyListenerDown);
            window.removeEventListener('keyup', this.bodyListenerUp);
        }


    }
</script>

<style scoped>

    body.ctrl td input {
        cursor: pointer;
    }

    body.ctrl td:hover {
        cursor: pointer;
        opacity: .7;
    }

    .tableCont {
        position: relative;
        margin-top: 15px;
    }

    .deleteRow {
        height: 25px;
        color: white;
    }


    .deleteCont {
        position: absolute;
        top: 2px;
        right: 5px;
    }

    .table {
        /*margin: 15px auto;*/
        /*display: flex;*/
        /*justify-content: space-between;*/
        /*flex-wrap: wrap;*/
    }

    .table thead {

    }

    .table td.selected {
        opacity: .5;
    }

    .table tr {
        width: 100%;
        /*display: flex;*/
        /*justify-content: space-between;*/

        padding: 15px;
    }

    .table tr td {
        /*flex: 1;*/
        text-align: center;
        background-color: #3dab4c;
        margin: 5px;
        width: 100%;
    }

    .table tr:first-child {
        background-color: green;
        color: white;
        /*display: flex;*/
        /*justify-content: space-around;*/
    }

    .table tr td:first-child {
        text-align: left;
    }

    .table input {
        background-color: transparent;
        color: white;
        outline: none;
        border: none;
    }


</style>
