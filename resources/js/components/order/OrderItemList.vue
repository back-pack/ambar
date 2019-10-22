<template>
    <div>
        <ul class="list-group">

            <order-item v-for="(item, index) in items"
                :key="index"
                :index="index"
                :item="item"
                :errors="errors"
                @update-item="updateItem"
                @remove-item="removeItem"
            ></order-item>

        </ul>

        <hr>

        <div class="alert alert-warning" v-show="items_below_cost">Hay articulos que se venden por debajo del costo.</div>

        <div class="row">
            <div class="col" v-show="weight > 0">
                <b>Peso total: {{ weight }}kg</b>
            </div>
            <div class="col" v-show="total > 0">
                <h3 class="float-right">Total: {{ total_formatted }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
import numeral from 'numeral'

export default {
    props: {
        items: Array,
        errors: Object,
    },
    computed: {
        total() {
            return this.items.reduce((sum, item) => sum + (item.subtotal || 0), 0)
        },
        total_formatted() {
            return numeral(this.total).format('$0,0.00')
        },
        weight() {
            return this.items.reduce((a, b) => a + ((b['weight'] || 0) * (b['quantity'] || 0)), 0)
        },
        items_below_cost() {
            let below_cost = this.items.filter(item => item.is_below_cost)
            return below_cost.length > 0
        }
    },
    watch: {
        total(value) {
            this.$emit('update-total', value)
            this.$emit('update-payment-amount', value)
        },
        weight(value) {
            this.$emit('update-weight', value)
        },
        items_below_cost(value) {
            this.$emit('update-items-below-cost', value)
        }
    },
    methods: {
        updateItem(value) {
            this.$emit('update-item', value)
        },
        removeItem(value) {
            this.$emit('remove-item', value)
        },
    }
}
</script>

<style lang="css" scoped>
</style>
