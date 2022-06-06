<template>
  <section>
    <b-field grouped group-multiline>
      <b-button
        label="Clear selected"
        type="is-danger"
        icon-left="close"
        :disabled="!selected"
        @click="selected = null"
      />

      <b-button
        label="Add customer"
        type="is-info"
        @click="addCustomerLink"
      />
    </b-field>

    <b-tabs>
      <b-tab-item label="Table">
        <b-table
          :data="items"
          :columns="columns"
          :selected.sync="selected"
          focusable
        />
      </b-tab-item>

      <b-tab-item label="Selected">
        <pre>{{ selected }}</pre>
      </b-tab-item>
    </b-tabs>
  </section>
</template>
<script>
export default {
  props: {
    columns: {
      type: Array,
      default: null
    },
    items: {
      type: Array,
      default: null
    },
    addRoute: {
      type: String,
      default: null
    },
  },
  data() {
    const data = this.items
    return {
      data,
      selected: this.items[1],
    }
  },

  methods: {
    addCustomerLink() {
      console.log(route(this.addRoute))
      Window.localion = route(this.addRoute)
    },
  },
}
</script>
