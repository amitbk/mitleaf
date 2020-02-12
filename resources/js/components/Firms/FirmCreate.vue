<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
export default {
  name: "FirmCreate",
  props: ['firm_types'],
  components: {
      // ImageUploader
  },
  data() {
    return {
        firm_type_id: 2,
    };
  },
  computed: {
  },
  methods: {

  }, // methods
};
</script>

<style lang="css" scoped>
</style>
