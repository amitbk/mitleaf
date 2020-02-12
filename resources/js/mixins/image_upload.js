export const image_upload = {
    data() {
          return {
              hasImage: false,
              image: {dataUrl: ''},
          }
      },
    methods: {
        displaySelectedImage() {
        try {
          let imageObject = this.$refs.image.files[0];
          let imageObjectURL = URL.createObjectURL(this.$refs.image.files[0]);
          this.templateImage = imageObjectURL;
        } catch (e) {
          console.log("Error", e);
        }
      },

      setImage(data) {
          this.hasImage = true;
          this.image = data;
      },
      startImageResize(data) {
      },
      endImageResize(data) {
      }
    }, // methods
};
