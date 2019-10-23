<template>
    <div>
        <div class="form-group">
            <label>El cliente debe: <b v-if="updating_debt === false">{{ debt_formatted }}</b> <span v-else class="spinner-border spinner-border-sm text-primary"></span></label>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="show_payment_input" v-model="show">
                <label for="show_payment_input" class="custom-control-label">Ingresar pago</label>
            </div>
        </div>

        <div v-show="show">
            <div class="form-group">
                <label for="payment_amount">Monto</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input
                        type="number"
                        :class="errors.has('payment_amount') ? 'form-control is-invalid' : 'form-control'"
                        :value="value"
                        @input="updateValue($event.target.value)"
                        step="any"
                        min="0"
                        :max="client_debt"
                    >
                    <span class="invalid-feedback" v-text="errors.get('payment_amount')"></span>
                </div>
            </div>

            <div>El cliente deberá: <b>{{ debt_after_payment }}</b></div>
        </div>

        <hr>
    </div>
</template>

<script>
import numeral from 'numeral'

export default {
    props: {
        value: Number,
        errors: Object,
        client_debt: Number,
        updating_debt: Boolean,
    },
    data() {
        return {
            show: false
        }
    },
    computed: {
        debt_formatted() {
            return numeral(this.client_debt).format('$0,0.00')
        },
        debt_after_payment() {
            return numeral(this.client_debt - this.value).format('$0,0.00')
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', parseFloat(value))
        }
    },
    watch: {
        show(value) {
            if (value === false) {
                this.updateValue(0)
            }
            if (value === true) {
                this.$emit('enter-payment')
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
