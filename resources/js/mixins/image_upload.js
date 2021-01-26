export const image_upload = {
    data() {
          return {
              hasImage: false,
              image: {dataUrl: ''},
              imageShape: 0
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

          // check image shape
          let diff = this.image.info.newWidth - this.image.info.newHeight;
          if(-10 < diff && diff < 10)
            this.imageShape = 1;
          else if( this.image.info.newWidth > this.image.info.newHeight )
              this.imageShape = 3; // landscape
          else this.imageShape = 2; // portrate

      },
      startImageResize(data) {
      },
      endImageResize(data) {
      }
    }, // methods
};
