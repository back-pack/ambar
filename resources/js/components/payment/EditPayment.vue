<template>
    <form @input="form.errors.clear($event.target.name)">
        <div>
            <div class="form-group">
                Cliente: <b>{{ payment.client.name }}</b>
            </div>
            <div class="form-group">
                <div>El cliente debe: <b>{{ money_format(payment.client.debt) }}</b></div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input
                         :class="form.errors.has('amount') ? 'form-control is-invalid' : 'form-control'"
                         type="number"
                         v-model="form.amount"
                         step="any"
                         min="0"
                         :max="payment.client.debt + payment.amount"
                     >
                     <span class="invalid-feedback" v-text="form.errors.get('amount')"></span>
                </div>
            </div>


            <div class="form-group">
                <div>El cliente deberá: <b>{{ money_format(payment.client.debt + payment.amount - form.amount) }}</b></div>
            </div>

            <system-error :error="system_error" @remove-error="clearSystemError"></system-error>

            <button type="submit" class="btn btn-primary" @click.prevent="submitForm" :disabled="disable_submit">Editar pago</button>
        </div>
    </form>
</template>

<script>
import numeral from 'numeral'
import Form from '../../classes/Form'

export default {
    props: {
        payment_id: String
    },
    data() {
        return {
            payment: {
                id: 1,
                amount: 0.00,
                client: {
                    id: 1,
                    debt: 0.00
                },
            },
            form: new Form({
                client_id: 1,
                amount: 0.00,
                order_id: 1
            }),
            system_error: null
        }
    },
    created() {
        let id = parseInt(this.payment_id)
        axios.get('/api/payments/'+id)
            .then(({data}) => {
                this.payment = data.data
                this.form.client_id = data.data.client.id
                this.form.amount = parseFloat(data.data.amount)
                this.form.order_id = data.data.order.id
            })
            .catch(data => {
                if (!data.errors) {
                    this.system_error = data
                }
            })
    },
    computed: {
        disable_submit(){
            if (this.form.amount <= this.payment.client.debt + this.payment.amount) {
                return false
            }
            return true
        },
    },
    methods: {
        submitForm() {
            this.form.submit('patch', '/payments/'+this.payment_id)
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
