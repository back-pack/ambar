<template>
    <li :class=" is_below_cost ? 'list-group-item list-group-item-warning' : 'list-group-item' ">
        <div class="row">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
              <div class="row">
                <div class="col-10 col-md-12 mt-md-2">{{ name }}</div>
                <div class="col-2 d-sm-block d-md-none">
                    <button type="button" class="btn btn-danger float-right" @click.prevent="$emit('remove-item', index)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-7">
              <div class="form-row">

                  <div class="col-lg col-6">

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Cant</span>
                      </div>
                      <input
                          type="number"
                          min="1"
                          :class="errors.has('articles.'+index+'.quantity') ? 'form-control is-invalid' : 'form-control'"
                          :value="item.quantity"
                          @input="updateQuantity"
                        >
                      <span class="invalid-feedback" v-text="errors.get('articles.'+index+'.quantity')"></span>
                    </div>

                  </div>
                  <div class="col-lg col-6">

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Precio</span>
                      </div>
                      <input
                          type="number"
                          min="0"
                          step="any"
                          :class="errors.has('articles.'+index+'.touched_price') ? 'form-control is-invalid' : 'form-control'"
                          :value="item.touched_price"
                          @input="updateTouchedPrice"
                        >
                      <span class="invalid-feedback" v-text="errors.get('articles.'+index+'.touched_price')"></span>
                    </div>

                  </div>
                  <div class="col-lg col-12 mt-2 mt-lg-0">
                      <div class="py-2 float-right">Subtotal: <b>{{ subtotal_formatted }}</b></div>
                      <div class="py-2 pr-2 float-right">Descuento: <b>{{ discount }}%</b></div>
                  </div>

              </div>
            </div>

            <div class="col-md-1 d-none d-md-block">
              <button type="button" class="btn btn-danger float-right" @click.prevent="$emit('remove-item', index)">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>

        </div>
    </li>
</template>

<script>
import roundTo from '../../classes/RoundTo'

export default {
    props: {
        item: Object,
        index: Number,
        errors: Object,
    },
    computed: {
        // price() {
        //     return this.item.article.price
        // },
        discount() {
            return parseInt(100 - (this.item.touched_price * 100) / this.item.price)
        },
        subtotal() {
            // let subtotal = (this.item.price * this.item.quantity) - (this.item.price * this.item.quantity) * (this.item.discount / 100)
            // return roundTo(5, subtotal)
            return this.item.touched_price * this.item.quantity
        },
        subtotal_formatted() {
            return numeral(this.subtotal).format('$0,0.00')
        },
        is_below_cost() {
            return this.subtotal < this.item.cost * this.item.quantity
        },
        name() {
            return this.item.name
        }
    },
    watch: {
        // price(value) {
        //     this.$emit('update-item', {index: this.index, field: 'price', value: value})
        // },
        discount(value) {
            this.$emit('update-item', {index: this.index, field: 'discount', value: value})
        },
        subtotal(value) {
            this.$emit('update-item', {index: this.index, field: 'subtotal', value: value})
        },
        is_below_cost(value) {
            this.$emit('update-item', {index: this.index, field: 'is_below_cost', value: value})
        }
    },
    methods: {
        updateQuantity(event) {
            let value = parseInt(event.target.value)
            this.$emit('update-item', {index: this.index, field: 'quantity', value: value})
        },
        updateTouchedPrice(event) {
            let value = event.target.value
            this.$emit('update-item', {index: this.index, field: 'touched_price', value: value})
        },
        // updateDiscount(event) {
        //     let value = parseInt(event.target.value)
        //     this.$emit('update-item', {index: this.index, field: 'discount', value: value})
        // }
    }
}
</script>

<style lang="css" scoped>
</style>
