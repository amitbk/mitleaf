<template>
    <div class="image__container">
        <div v-if="!src" class="no-image fl_bg_gray h-100 p-2" :class="{h200: postView == 1}">
          {{noImageMsg}}
        </div>
        <img v-else class="img-fluid w-100" :src="src" alt="" :class="postView == 2 ? 'card__image img-fluid h-100 w-100 pr-3 pr-sm-0' : '' ">
        <slot></slot>
    </div>
</template>

<script>
// import ImageUploader from 'vue-image-upload-resize'
export default {
  name: "ImagePreview",
  props: {
          image: {
            type: Object
          },
          noImageMsg: {
            type: String,
            default: "No Image"
          },
          postView: {
            type: Number,
            default: 1
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
.h200 {
  height: 200px;
}

.no-image {
  display: grid;
  align-items: center;
  justify-content: center;
}
</style>
