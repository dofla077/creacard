<template>
  <section>
    <div v-if="alertMessage" class="notification is-danger">
      <ul>
        <li v-for="(errorMsg, key) in errorMessages" :key="key">
          {{ errorMsg[0] }}
        </li>
      </ul>
    </div>

    <b-field label="Firstname">
      <b-input v-model="form.firstname" />
    </b-field>
    <b-field label="Lastname">
      <b-input v-model="form.lastname" />
    </b-field>

    <b-field
      label="Email"
    >
      <b-input
        v-model="form.email"
        type="email"
        maxlength="30"
      />
    </b-field>

    <b-field label="Phone number">
      <b-input v-model="form.phone" maxlength="30" />
    </b-field>

    <b-field label="Address">
      <b-input v-model="form.address" maxlength="30" />
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
  name: 'CreateCustomer',
  props: {
    submitAction:{
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
      firstname: '',
      lastname: '',
      email: '',
      phone: '',
      address: '',
    },
    errorMessages: [],
    alertMessage: false

  }),
  methods: {
    save() {
      let redirectUrl = this.redirectUrl
      let routeAction = this.submitAction

      this.$axios.post(route(routeAction), this.form)
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

