<template>
  <section>
    <div v-if="alertMessage" class="notification is-danger">
      <ul>
        <li v-for="(errorMsg, key) in errorMessages" :key="key">
          {{ errorMsg[0] }}
        </li>
      </ul>
    </div>

    <b-field label="Label">
      <b-input v-model="form.label" />
    </b-field>

    <b-field label="Customer">
      <b-select v-model="form.customer_id" placeholder="Select Customer" expanded>
        <option v-for="customer in customers" :key="customer.id" :value="customer.id">
          {{ customer.firstname }} {{ customer.lastname }}
        </option>
      </b-select>
    </b-field>

    <b-field label="Price">
      <b-input v-model="form.price" />
    </b-field>

    <b-field label="Description" horizontal>
      <b-input v-model="form.description" maxlength="200" type="textarea" />
    </b-field>

    <b-field>
      <p class="control">
        <b-button label="Send message" type="is-primary" @click="save" />
      </p>
    </b-field>
  </section>
</template>
<script>
export default {
  name: 'QuotationForm',
  props: {
    customers: {
      type: Array,
      default: null,
    },
    quotation: {
      type: Object,
      default: null,
    },
    submitAction:{
      type: String,
      default: null
    },
    update:{
      type: String,
      default: null
    },
    redirectUrl:{
      type: String,
      default: null
    }
  },
  data: () => ({
    form: {
      customer_id: '',
      label: '',
      price: '',
      description: '',
    },
    errorMessages: [],
    alertMessage: false

  }),
  mounted() {
    this.quotationPopulate()
  },
  methods: {
    quotationPopulate() {
      this.form  = {
        id: this.quotation ? this.quotation.id : '',
        customer_id: this.quotation ? this.quotation.customer_id : '',
        label: this.quotation ? this.quotation.label : '',
        price: this.quotation ? this.quotation.price : '',
        description: this.quotation ? this.quotation.description : '',
      }
    },
    clearErrorMessages() {
      this.errorMessages = []
      this.alertMessage = false
    },
    getAction() {
      return this.update ? 'put' : 'post'
    },
    getRouteAction() {
      return this.update
        ? route(this.submitAction, this.form.id)
        : route(this.submitAction)
    },
    save() {
      this.clearErrorMessages()
      let redirectUrl = this.redirectUrl
      let routeAction = this.getRouteAction()
      let action = this.getAction()

      this.$axios[action](routeAction, this.form)
        .then(response => {
          if (response.data) {
            window.location = route(redirectUrl)
          }
        })
        .catch(error => {
          this.errorMessages = error.response.data.errors
          this.alertMessage = true
        })
    },
  }
}
</script>
<style scoped />

