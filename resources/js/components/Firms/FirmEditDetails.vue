<template>
    <div class="firm__container">
        <slot></slot>
    </div>
</template>

<script>
import ImageUploader from 'vue-image-upload-resize';
import {image_upload} from "../../mixins/image_upload";
export default {
  name: "FirmEditDetails",
  mixins: [image_upload],
  components: {
      ImageUploader
  },
  data() {
    return {
        firm_type_id: 2,
        hasImage: false,
        image: {dataUrl: ''},
        templateImage: '/images/no_image.png',
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
