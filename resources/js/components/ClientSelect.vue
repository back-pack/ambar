<template>
    <div class="form-group">
        <label for="client_id">Cliente</label>
        <div class="spinner-border spinner-border-sm text-primary" role="status" v-show="loading">
            <span class="sr-only">Cargando...</span>
        </div>
        <select class="custom-select" :value="value" @input="updateValue($event.target.value)">
            <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        value: Number
    },
    data() {
        return {
            clients: [],
            loading: false
        }
    },
    created() {
        this.loading = true
        axios.get('/api/clients')
            .then(({data}) => {
                this.clients = data.data
                this.updateMargin(this.clients[0].margin_profit)
            })
            .finally(() => this.loading = false)
    },
    methods: {
        updateValue(value) {
            let client = this.clients.find(client => client.id == value)
            this.$emit('input', client.id)
            this.updateMargin(client.margin_profit)
        },
        updateMargin(value) {
            this.$emit('update-margin', value)
        }
    }

}
</script>

<style lang="css" scoped>
</style>
