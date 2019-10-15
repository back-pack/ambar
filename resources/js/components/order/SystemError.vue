<template>
    <div v-if="show" class="alert alert-danger alert-dismissible fade show">
        <p><b>{{ error.message }}</b></p>
        <p>Exception: {{ error.exception }} at {{ error.file }} on line {{ error.line }}</p>
        <button type="button" class="close" @click.prevent="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        error: Object
    },
    data() {
        return {
            show: false
        }
    },
    watch: {
        error(value) {
            if (value !== null) {
                this.show = true
            } else {
                this.show = false
            }
        }
    },
    methods: {
        close() {
            this.$emit('remove-error')
        }
    }
}
</script>

<style lang="css" scoped>
</style>
