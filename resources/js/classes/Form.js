import Errors from '../classes/Errors'

class Form {

    constructor(data) {

        this.originalData = data

        for (var field in data) {
            this[field] = data[field]
        }

        this.errors = new Errors()
    }

    set(field, value) {
        if (this[field]) {
            this[field] = value
        }
    }

    data() {
        let data = {}

        for (let property in this.originalData) {
            data[property] = this[property]
        }

        return data
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = null
        }

        this.errors.clear()
    }

    submit(requestType, url, resolve, reject) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
            .then(response => {
                this.onSuccess(response.data)

                resolve(response.data)
            })
            .catch(error => {
                this.onFail(error.response.data)

                reject(error.response.data)
            })
        })
    }

    onSuccess() {

    }

    onFail(data) {
        console.log(data.errors)
        this.errors.record(data.errors)
    }

}

export default Form
