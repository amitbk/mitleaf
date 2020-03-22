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
  props: ['frameProp'],
  components: {
  },
  data() {
    return {
        frame: this.frameProp,
        // frameImage: this.frameProp.image,
    };
  },
  computed: {
  },
  methods: {
      onRecreateFrameClick() {

          axios.post('/recreate_frame', this.frame).then(res => {
              this.frame = res.data;
          })
      }
  }, // methods
};
</script>

<style lang="css" scoped>
</style>
