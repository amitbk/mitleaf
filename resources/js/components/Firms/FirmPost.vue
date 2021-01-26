<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
import axios from "axios";
export default {
  name: "FirmPost",
  props: ['postProp'],
  components: {
  },
  data() {
    return {
        post: this.postProp,
    };
  },
  computed: {
  },
  methods: {
      onRecreatePostClick() {

          axios.post('/recreate_post', this.post).then(res => {
              this.post = res.data;
          })
      }
  }, // methods
};
</script>

<style lang="css" scoped>
</style>
