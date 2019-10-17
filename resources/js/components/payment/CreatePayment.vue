<template>
    <form @input="form.errors.clear($event.target.name)">
        <div>
            <div class="form-group">
                <select class="custom-select" v-model="form.client_id" @input="updateClient($event.target.value)">
                    <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                </select>
            </div>

            <div class="form-group">
                <div>El cliente debe: <b>{{ money_format(client.debt) }}</b></div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input class="form-control" type="number" v-model="form.amount" min="0" :max="client.debt">
                </div>
            </div>

            <div class="form-group">
                <div>El cliente deberá: <b>{{ money_format(client.debt - form.amount) }}</b></div>
            </div>

            <system-error :error="system_error" @remove-error="clearSystemError"></system-error>

            <button type="submit" class="btn btn-primary" @click.prevent="submitForm" :disabled="disable_submit">Crear pago</button>
        </div>
    </form>
</template>

<script>
import numeral from 'numeral'
import Form from '../../classes/Form'

export default {
    data() {
        return {
            form: new Form({
                client_id: 1,
                amount: 0.00
            }),
            clients: [],
            client: {
                id: 1,
                debt: 0.00
            },
            system_error: null
        }
    },
    created() {
        axios.get('/api/clients?with-debt=1')
            .then(({data}) => {
                this.clients = data.data
                this.client = data.data[0]
                this.form.client_id = data.data[0].id
            })
            .catch(data => {
                if (!data.errors) {
                    this.system_error = data
                }
            })
    },
    computed: {
        disable_submit(){
            if (this.form.amount <= this.client.debt) {
                return false
            }
            return true
        },
    },
    methods: {
        submitForm() {
            this.form.submit('post', '/payments')
                .then(data => window.location.href = "/payments")
                .catch(data => {
                    if (!data.errors) {
                        this.system_error = data
                    }
                })
        },
        updateClient(id) {
            this.client = this.clients.find(client => client.id == id)
        },
        money_format(value) {
            return numeral(value).format('$0,0.00')
        },
        clearSystemError() {
            this.system_error = null
        }
    }
}
</script>

<style lang="css" scoped>
</style>
