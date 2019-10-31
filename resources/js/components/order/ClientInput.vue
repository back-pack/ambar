<template>
    <div>
        <div class="form-group">
            <label for="">Cliente</label>
            <input type="text" class="form-control" name="" v-model="term" @keyup="getClients">
        </div>
        <ul class="list-group">
            <li class="list-group-item" v-for="item in items" @click="updateValue(item)">{{ item.name }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        value: Number,
    },
    data() {
        return {
            term: "",
            items: [],
            data: {}
        }
    },
    created() {
        axios.get('/api/clients')
            .then(({data}) => {
                this.data = data.data
                let first = this.data.find(item => item.id == this.value)
                this.term = first.name
            })
    },
    methods: {
        getClients() {
            this.items = this.data.filter(item => {
                let patt = new RegExp(this.term, 'gi')
                return patt.test(item.name)
            })
        },
        updateValue(item) {
            this.$emit('input', item.id)
            this.term = item.name
            this.items = []
        }
    }
}
</script>

<style lang="css" scoped>
</style>
