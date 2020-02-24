<template>
    <div class="image__container">
        <div v-if="!src" class="no-image fl_bg_gray">
          {{noImageMsg}}
        </div>
        <img v-else class="img-fluid w-100" :src="src" alt="">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
export default {
  name: "ImagePreview",
  props: {image: {
            type: Object
          },
          noImageMsg: {
            type: String,
            default: "No Image"
          }
        },
  components: {
      // ImageUploader
  },
  computed: {
    src: function() {
      return !!this.image ? "/"+this.image.url : null;
    }
  }, 
  methods: {

  }, // methods
}
</script>

<style lang="css" scoped>
.no-image {
  height: 200px;
  display: grid;
  align-items: center;
  justify-content: center;
}
</style>
