<template>
      <div class="form-group">
          <label for="">Buscar artículo</label>
          <div class="spinner-border spinner-border-sm text-primary" role="status" v-show="loading">
              <span class="sr-only">Cargando...</span>
          </div>
          <input class="form-control" type="text" v-model="term" @keyup="getArticles()">
          <ul class="list-group">
              <a :href="'/articles/' + item.id + '/edit'" class="list-group-item list-group-item-action list-group-item-light" v-for="item in data">{{ item.name }}</a>
          </ul>
      </div>
</template>

<script>
export default {
    data() {
        return {
            term: "",
            data: [],
            loading: false,
        }
    },
    methods: {
        getArticles() {
            if (this.term !== '') {
                this.loading = true
                axios.get('/api/articles', {params: {search: this.term}})
                    .then(({data}) => this.data = data.data)
                    .finally(() => this.loading = false)
            } else {
                this.data = []
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
