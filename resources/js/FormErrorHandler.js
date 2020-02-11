class FormErrorHandler {
  constructor(){
    this.errors = {}
  }

  get(field) {
    return this.errors[field]
      ? this.errors[field][0]
      : null
  }

  set(errors){
    this.errors = errors
  }

  has(field) {
    return this.errors.hasOwnProperty(field)
  }

  any() {
    return Object.keys(this.errors).length > 0
  }

  clear(field = null){
    if (field) {
      delete this.errors[field]

      return
    }

    this.errors = {}
  }
}