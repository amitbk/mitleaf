<template>
  <div>
    <div class="d-flex flex-wrap">
      <div class="p-1 mr-auto">
        <span v-if="!!$root.post.template_id" class="text-success font-weight-bold">Template is selected.</span>
        <button v-else @click="addLogo" class="btn btn-info btn-sm">Add Logo</button>
      </div>

      <div class="p-1">
        <select v-model="$root.post.firm_id" class="form-control form-control-sm" style="width: auto" >
          <option value="0">Select Business</option>
          <option :value="firm.id" v-for="firm in $root.mitleaf.firms">{{firm.name}}</option>
        </select>
      </div>

      <div class="p-1">
        <select v-model="$root.post.plan_id" class="form-control form-control-sm" style="width: auto" >
          <option value="0">Select Plan</option>
          <option :value="plan.id" v-for="plan in $root.mitleaf.plans">{{plan.name}}</option>
        </select>
      </div>

      <div class="p-1">
        <div class="form-group" style="width: auto">
          <input v-model="$root.post.schedule_on" type="date" class="form-control form-control-sm" id="usr">
        </div>
      </div>
      <!-- <button @click="processDone" class="btn btn-info btn-sm ">Schedule</button> -->
      <div class="p-1">
        <button class="btn btn-success btn-sm" @click="onSaveClick"> Save</button>
      </div>

    </div>
    <div v-if="!!$root.post.template_id" class="text-success font-weight-bold text-center">(This is template preview only, logo will be added automatically after saving.)</div>
    <div v-else>
      <div class="form-group" style="width: auto">
        <input v-model="$root.post.content" type="text" class="form-control form-control-sm" placeholder="Enter content, hashtags, message to post with image (optional)">
      </div>
    </div>

    <div class="p-3" style="overflow: scroll;">
      <canvas id="canvas"
          style="border:1px solid #000000">
      </canvas>
    </div>

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
      this.canvas = new fabric.Canvas("canvas");

      this.canvas.setHeight(400);
      this.canvas.setWidth(550);

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
  },
  methods: {
    addLogo() {
      let self = this;
      fabric.Image.fromURL(this.$root.mitleaf.firms[0].logo, function(oImg) {
        self.canvas.add(oImg);
      });
    },
    onSaveClick() {

      if( !!this.$root.post.template_id == false ) {
        this.canvas.discardActiveObject().renderAll();
        let dataURL = canvas.toDataURL({
          format: 'jpg',
          quality: 0.8
        });
        this.$root.post.templateImageUrl = dataURL;
      }

      this.$emit('save');
    },
  }
}
</script>

<style>
.canvas-container {
  margin: 0 auto;
}
</style>
