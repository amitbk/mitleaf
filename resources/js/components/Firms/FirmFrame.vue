<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
import axios from "axios";
export default {
  name: "FirmFrame",
  props: ['frame'],
  components: {
  },
  data() {
    return {
        frameImage: this.frame.image
    };
  },
  computed: {
  },
  methods: {
      onRecreateFrameClick() {

          axios.post('/recreate_frame', this.frame).then(res => {

              this.frameImage = res.data;
          })
      }
  }, // methods
};
</script>

<style lang="css" scoped>
</style>
