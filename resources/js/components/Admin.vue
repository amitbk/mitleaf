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
      isToggeled: false
    }
  },
  components: {
  },
  computed: {
  },
  methods: {

    toggleSidebar() {
      this.isToggeled = !this.isToggeled;
      $('#sidebar, #content').toggleClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    },
    changeUserStatus() {
        console.log("Submit Form", this.localPlans);
        axios.post('/users/status', data ).then(response => {
            console.log("Submited: ",response);
        })
    },
  }, // methods
}
</script>

<style lang="css" scoped>

</style>
