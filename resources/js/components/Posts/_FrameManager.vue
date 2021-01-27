<template>
  <div>
    Edit Post Image
    <button @click="addLogo" class="btn btn-info btn-sm">Add Logo</button>
    <button @click="getImage" class="btn btn-info btn-sm">Get Now</button>
    <button @click="processDone" class="btn btn-info btn-sm">Next</button>
    <br>
    <canvas id="canvas"
        style="border:1px solid #000000">
    </canvas>
    <!-- <button @click="processDone">Done</button> -->
    <!-- <img :src="$root.post.templateImageUrl" alt="Template image" class="img-fluid"> -->
  </div>
</template>

<script>
const fabric = require("fabric").fabric;

export default {
  data () {
    return {
      width: 300, height: 200,
      canvas: null
    }
  },
  mounted() {

      // let url = this.$root.post.templateImageUrl;
      // let options = {id: this.$uuid.v1()};
      // this.$refs.canvas.createImage(url,options)

      this.canvas = new fabric.Canvas("canvas");

      // Get the image element
      // var image = document.getElementById('my-image');
      // console.log("image: ", image.height, image.width);
      //
      // this.canvas.setHeight(image.height);
      // this.canvas.setWidth(image.width);

      this.canvas.setHeight(400);
      this.canvas.setWidth(550);

      // var image2 = document.getElementById('my-image2');
      //
      // // Initiate a Fabric instance
      // var fabricImage = new fabric.Image(image);
      // var fabricImage2 = new fabric.Image(image2);
      let self = this;
      // fabric.Image.fromURL(this.$root.post.templateImageUrl, function(oImg) {
      //   self.canvas.add(oImg);
      // });

      fabric.Image.fromURL(this.$root.post.templateImageUrl, function(img) {
         // add background image
         self.canvas.setBackgroundImage(img, self.canvas.renderAll.bind(self.canvas), {});
      });

      var img = new Image();
      img.onload = function(){
          self.canvas.setHeight(this.height);
          self.canvas.setWidth(this.width);
      };
      img.src = this.$root.post.templateImageUrl


    // fabric.Image.fromURL('https://cdn.pixabay.com/photo/2014/02/27/16/10/tree-276014__340.jpg', function(oImg) {
    //   this.canvas.add(oImg);
    // });



  },
  methods: {
    addLogo() {
      let self = this;
      fabric.Image.fromURL(this.$root.mitleaf.firms[0].logo, function(oImg) {
        self.canvas.add(oImg);
      });
    },

    getImage() {
      this.canvas.discardActiveObject().renderAll();
      var dataURL = canvas.toDataURL({
        format: 'jpeg',
        quality: 0.8
      });

      console.log(dataURL);
    },
    processDone() {
      this.canvas.discardActiveObject().renderAll();
      let dataURL = canvas.toDataURL({
        format: 'jpg',
        quality: 0.8
      });

      console.log(dataURL);
      this.$root.post.templateImageUrl = dataURL;
      this.$emit('process-done', 2);
    }
  }
}
</script>

<style>

</style>
