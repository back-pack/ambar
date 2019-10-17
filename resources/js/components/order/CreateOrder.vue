<template>
    <div>
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pedido sin pago</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El pedido no tiene ningun pago. ¿Desea continuar?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="submitForm">Si</button>
          </div>
        </div>
      </div>
    </div>
        <form @input="form.errors.clear($event.target.name)">

            <client-select
                v-model="form.client_id"
            ></client-select>

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

            <payment-input
                v-model="form.payment_amount"
                :errors="form.errors"
                :client_debt="client_debt_total"
                :updating_debt="updating_debt"
            ></payment-input>

            <system-error :error="system_error" @remove-error="clearSystemError"></system-error>

            <button type="button" class="btn btn-primary" @click.prevent="attempt_submit" :disabled="disable_submit">Crear pedido</button>

        </form>
    </div>
</template>

<script>
import Form from '../../classes/Form'
import roundTo from '../../classes/RoundTo'

export default {
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
                payment_amount: 0.00
            }),
            client_debt: 0,
            updating_debt: false,
            items_below_cost: false,
            system_error: null,
        }
    },
    created() {
        axios.get('/api/user')
            .then(({data}) => this.user = data.data)
            .catch(data => {
                if (!data.errors) {
                    this.system_error = data
                }
            })

        this.updating_debt = true
        axios.get('/api/clients/'+this.form.client_id)
            .then(({data}) => {
                this.client_debt = data.data.debt
                this.updating_debt = false
            })
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
        },
        client_debt_total() {
            return this.client_debt + this.form.total
        }
    },
    watch: {
        'form.client_id': function () {
            this.updating_debt = true
            axios.get('/api/clients/'+this.form.client_id)
                .then(({data}) => {
                    this.client_debt = data.data.debt
                    this.updating_debt = false
                })
                .catch(data => {
                    if (!data.errors) {
                        this.system_error = data
                    }
                })
        }
    },
    methods: {
        attempt_submit()
        {
            if (this.form.payment_amount == 0.00) {
                $('#myModal').modal('toggle')
            } else {
                this.submitForm();
            }
        },
        submitForm() {
            this.form.submit('post', '/orders')
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
        updateClientDebt(value) {
            this.client_debt = value
        },
        clearSystemError() {
            this.system_error = null
        }
    }
}
</script>

<style lang="css" scoped>
</style>
