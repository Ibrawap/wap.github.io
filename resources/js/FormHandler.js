class FormHandler {
  constructor(data){
    this.formData = data

    for (let field in data) {
      this[field] = data[field]
    }

    this.errors = new FormErrorHanler()
  }

  post(url) {
    this.submit('post', url)
  }

  submit(type, url) {
    return new Promise((resolve, reject) => {
      axios[type](url, this.payload)
      .then(res => {
        this.onSuccess.(res.data)

        resolve(res.data)
      })
      .catch(error => {
        this.onFailure(error.response.data)

        reject(error.response.data)
      })
    })
  }

  payload() {

    const payload = {}

    for (const property in this.formData) {
      payload[property] = this[property]
    }

    return payload

    // const data = Object.assign({}, this)

    // delete data.formData
    // delete data.errors

    // return data
  }

  reset() {
    for (let field in this.formData) {
      this[field] = null
    }

    this.error.clear()
  }

  onSuccess(data) {
    alert('done')

    this.reset()
  }

  onFailure(error) {
    this.errors.set(error.response.data)
  }
}