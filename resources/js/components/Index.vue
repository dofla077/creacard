<template>
  <section>
    <b-field grouped group-multiline>
      <b-button
        label="Add customer"
        type="is-info"
        @click="addCustomerLink"
      />
    </b-field>

    <b-table
      ref="table"
      :data="items"
      :columns="columns"
    >
      <b-table-column v-slot="props" field="label" label="Label" centered>
        <span class="tag is-success">
          {{ props.row.label }} toot
        </span>
      </b-table-column>
    </b-table>
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
