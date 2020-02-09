<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "CreateTemplate",
  props: ["plans"],
  data() {
    return {
        templateImage: '/images/no_image.png',
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
  }, // methods
};
</script>

<style lang="css" scoped>

</style>
