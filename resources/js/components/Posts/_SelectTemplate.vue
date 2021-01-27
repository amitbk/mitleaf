<template>
  <div class="template__wrapper">
    <div class="font-weight-bold d-flex">
      <div>
        Select Template
      </div>

      <div class="form-group ml-2">
        <select v-model="$root.post.plan_id" v-if="!!$root.mitleaf.plans" @change="getTemplates($event)" class="form-control form-control-sm" id="category">
          <option value="0">Select Type</option>
          <option :value="plan.id" v-for="plan in $root.mitleaf.plans.filter(el => !!el.is_post_plan)">{{plan.name}}</option>
        </select>

      </div>


    </div>

      <hr>

      <div class="row text-center text-lg-left">

        <div class="col-lg-3 col-md-4 col-6 text-center pt-3">

          <!-- <button class="btn btn-outline-primary">
            <div><i class="fas fa-cloud-upload-alt fa-3x"></i></div>
            Upload your design</button> -->

            <image-uploader
                :debug="1"
                :max-width="600"
                :quality="0.7"
                :auto-rotate=true
                output-format="verbose"
                :preview=true
                :class-name="['fileinput', { 'fileinput--loaded' : hasImage }]"
                :capture="false"
                accept="video/*,image/*"
                doNot-resize="['gif', 'svg']"
                @input="setImage"
                @on-upload="startImageResize"
                @on-complete="endImageResize"
              >
              <span class="clearfix"></span>
              <label for="fileInput" slot="upload-label">
                <div class="upload-caption">{{ hasImage ? 'Replace File' : 'Upload image' }}</div>
              </label>

            </image-uploader>

        </div>

        <template v-for="template in $root.templates.data">
          <div v-if="!!template.image" class="col-lg-3 col-md-4 col-6">
            <a @click="selectTemplateImage(template)" href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" :src="template.image.url" alt="">
            </a>
          </div>
        </template>


      </div>


    <!-- https://picsum.photos/200/300 -->
  </div>
</template>

<script>
import ImageUploader from 'vue-image-upload-resize'
import {image_upload} from "../../mixins/image_upload";

export default {
  components: {
      ImageUploader
  },
  mixins: [image_upload],

  watch: {
    image: function (newVal, oldVal) {
      this.$root.post.templateImageUrl = newVal.dataUrl;
      this.$emit('process-done', 1);
    }
  },
  methods: {
    getTemplates: function (ev) {
      this.$emit('get-templates', { filters: { plan_id: ev.target.value } } );
    },

    selectTemplateImage(template) {
      this.$root.post.template_id = template.id;
      this.$root.post.templateImageUrl = template.image.url;
      // this.$emit('template-selected');
      this.$emit('process-done', 1);

    }
  }
}
</script>

<style>

</style>
