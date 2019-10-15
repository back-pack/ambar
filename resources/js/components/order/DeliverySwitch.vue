<template>
    <div>
        <div class="form-group">
            <label for="">Entrega</label>
            <div class="input-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="delivery-switch" v-model="showDateInput">
                    <label for="delivery-switch" class="custom-control-label">Venta en la calle</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group" v-show="showDateInput">
                <input
                    type="date"
                    :class="errors.has('delivery') ? 'form-control is-invalid' : 'form-control'"
                    name="delivery"
                    :value="value"
                    @input="updateValue($event.target.value)"
                >
                <span class="invalid-feedback" v-text="errors.get('delivery')"></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: String,
        errors: Object
    },
    data() {
        return {
            showDateInput: false,
            today: new Date().toJSON().split('T')[0]
        }
    },
    methods: {
        updateValue(value) {
            this.$emit('input', value)
        }
    },
    watch: {
        value(value) {
            if (value !== null) {
                this.showDateInput = true
            }
        },
        showDateInput(value) {
            if (!value) {
                this.updateValue(null)
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
