<template>
    <div class="admin__container">
      <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
export default {
  name: "Admin",
  props: { },
  data() {
    return {
      admin: true,
    }
  },
  components: {
  },
  computed: {
  },
  methods: {

    changeUserStatus() {
        console.log("Submit Form", this.localPlans);
        axios.post('/users/status', data ).then(response => {
            console.log("Submited: ",response);
        })
    }
  }, // methods
}
</script>

<style lang="css" scoped>

</style>
