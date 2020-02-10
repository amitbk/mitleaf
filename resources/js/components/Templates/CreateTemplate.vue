<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
import ImageUploader from 'vue-image-upload-resize'
import axios from 'axios';
export default {
  name: "CreateTemplate",
  props: ["plans"],
  components: {
      ImageUploader
  },
  data() {
    return {
        msg: "Vue Image Upload and Resize Demo",
        hasImage: false,
        image: {dataUrl: ''},

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
      // logoSupports: function() {
      //     let ls = {};
      //     !!this.logoSupport.bottomCenter ?? ls.push(11);
      //     !!this.logoSupport.bottomLeft ?? ls.push(12);
      //     !!this.logoSupport.bottomRight ?? ls.push(13);
      //     !!this.logoSupport.topCenter ?? ls.push(14);
      //     !!this.logoSupport.topCenter ?? ls.push(15);
      //     !!this.logoSupport.topCenter ?? ls.push(16);
      //     !!this.logoSupport.centerCenter ?? ls.push(17);
      //     !!this.logoSupport.centerCenter ?? ls.push(18);
      //     !!this.logoSupport.centerCenter ?? ls.push(19);
      //     return ls;
      // }
  },
  methods: {
      displaySelectedImage() {
      console.log("handleFileUpload() called. ", this.$refs.image.files);
      try {
        let imageObject = this.$refs.image.files[0];
        let imageObjectURL = URL.createObjectURL(this.$refs.image.files[0]);
        this.templateImage = imageObjectURL;
      } catch (e) {
        console.log("Error", e);
      }
    },

    setImage(data) {
        console.log("71", data);
        this.hasImage = true;
        this.image = data;
    },
    startImageResize(data) {
        console.log("74", data);
    },
    endImageResize(data) {
        console.log("77", data);
    }
  }, // methods
};
</script>

<style lang="css" scoped>
    .upload-caption {
        padding: 10px;
        background: #6cb2eb;
        display: table;
        color: #ffffff;
        border: 1px solid #fff;
        border-radius: 4px;
        margin: 10px;
     }
</style>
<style media="screen">
.fileinput {
    display: none;
}
.img-preview {
    display: flex;
    margin: 0 auto;
}
</style>
