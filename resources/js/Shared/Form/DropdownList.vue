<template>
    <div class="form-group">
        <label>{{ label }}</label>
        <select class="form-control m-input" v-model="row_id" @change="emitData">
            <option value="">-Select-</option>
            <option v-for="(item,index) in rows" :value="item.id" :key="index">{{ item.name }}</option>
        </select>
    </div>
</template>

<script>
import {HTTP} from '@/utils/http-common'

export default {
    props: ['label', 'endpoint', 'model'],
    data () {
        return {
            rows: [],
            row_id: ''
        }
    },
    mounted () {
        this.getList()
    },
    methods: {
        getList () {
            HTTP.get(`/${this.endpoint}`).then(response => {
                this.rows = response.data
                this.row_id = this.model
                // this.row_id = this.rows[0].id
                this.emitData()
            })
            // HTTP.get('/house-list').then(response => {
            //     this.rows = response.data
            //     this.row_id = this.rows[0].id
            //     this.emitData()
            // })
        },
        emitData () {
            this.$emit('rowId', this.row_id)
        }
    }
}
</script>
