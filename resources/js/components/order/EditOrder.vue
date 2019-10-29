<template>
    <form class="needs-validation" @keydown="form.errors.clear($event.target.name)">

        <client-input
            v-model="form.client_id"
        ></client-input>

        <delivery-switch
            v-model="form.delivery"
            :errors="form.errors"
        ></delivery-switch>

        <article-search-input
            @add-item="addItem"
            :errors="form.errors"
        ></article-search-input>

        <order-item-list
            :items="form.articles"
            :errors="form.errors"
            @update-item="updateItem"
            @remove-item="removeItem"
            @update-total="updateTotal"
            @update-weight="updateWeight"
            @update-items-below-cost="updateItemsBelowCost"
        ></order-item-list>

        <div class="form-group">
            <label for="">Detalle</label>
            <textarea name="detail" class="form-control" rows="5" cols="80" v-model="form.detail"></textarea>
        </div>

        <system-error :error="system_error" @remove-error="clearSystemError"></system-error>

        <button type="button" class="btn btn-primary" @click.prevent="submitForm" :disabled="disable_submit">Editar pedido</button>

    </form>
</template>

<script>
import Form from '../../classes/Form'
import roundTo from '../../classes/RoundTo'

export default {
    props: {
        order_id: String,
    },
    data() {
        return {
            user: {
                is_admin: false
            },
            form: new Form({
                client_id: 1,
                delivery: null,
                articles: [],
                detail: "",
                total: 0.00,
                weight: 0.00,
            }),
            items_below_cost: false,
            system_error: null
        }
    },
    created() {
        axios.get('/api/orders/'+this.order_id)
            .then(response => this.form = new Form(response.data.data))
            .catch(data => {
                if (!data.errors) {
                    this.system_error = data
                }
            })

        axios.get('/api/user')
            .then(({data}) => this.user = data.data)
            .catch(data => {
                if (!data.errors) {
                    this.system_error = data
                }
            })
    },
    computed: {
        disable_submit(){
            if (this.user.is_admin) {
                return false
            }
            if (!this.items_below_cost) {
                return false
            }
            return true
        }
    },
    methods: {
        submitForm() {
            this.form.submit('patch', '/orders/'+this.order_id)
                .then(data => window.location.href = "/orders/"+data)
                .catch(data => {
                    if (!data.errors) {
                        this.system_error = data
                    }
                })
        },
        addItem(article) {
            let quantity = 1
            let touched_price = article.price
            let discount = 0
            let is_below_cost = false
            let name = article.name
            let cost = article.cost
            let price = article.price
            let weight = article.weight
            let subtotal = price * quantity

            this.form.articles.push({
                article,
                quantity,
                touched_price,
                discount,
                subtotal,
                is_below_cost,
                name,
                cost,
                price,
                weight
            })
        },
        updateItem({ index, field, value }) {
            this.form.articles[index][field] = value
        },
        removeItem(index) {
            this.form.articles.splice(index, 1)
        },
        updateTotal(value) {
            this.form.total = value
        },
        updateItemsBelowCost(value) {
            this.items_below_cost = value
        },
        updateWeight(value) {
            this.form.weight = value
        },
        clearSystemError() {
            this.system_error = null
        }
    }
}
</script>

<style lang="css" scoped>
</style>
