<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
import ImageUploader from 'vue-image-upload-resize'
import axios from 'axios';
import {image_upload} from "../../mixins/image_upload";
export default {
  name: "CreateTemplate",
  props: ["plans"],
  mixins: [image_upload],
  components: {
      ImageUploader
  },
  data() {
    return {
        templateImage: '/images/no_image.png',
        planSelected: 2,
        logoSupport: {
            bottomCenter: true,
            bottomLeft: false,
            bottomRight: false,

            topCenter: false,
            topLeft: false,
            topRight: false,

            centerCenter: false,
            centerLeft: false,
            centerRight: false,
        },
        stripSupport: {
            bottomTouched: false,
            bottomWithPadding: false
        }
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
