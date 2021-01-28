<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
export default {
  name: "FirmCreate",
  props: ['firm_types', 'firmTypeId'],
  components: {
      // ImageUploader
  },
  data() {
    return {
        firm_type_id: this.firmTypeId,
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
