<template>
  <div class="template__wrapper">
    <div class="font-weight-bold d-flex">

      <div class="form-group ml-2">
        <select v-model="$root.post.plan_id" v-if="!!$root.mitleaf.plans" @change="getTemplates($event)" class="form-control form-control-sm" id="category">
          <option value="0">All Templates</option>
          <option :value="plan.id" v-for="plan in $root.mitleaf.plans.filter(el => !!el.is_post_plan)">{{plan.name}}</option>
        </select>

      </div>
      <div class="ml-auto">
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
            <div class="btn btn-primary btn-sm">{{ hasImage ? 'Replace File' : 'Upload image' }}</div>
          </label>
        </image-uploader>
      </div>

    </div>

      <div v-if="!!$root.templates.data && $root.templates.data.length > 0" class="row text-center text-lg-left">
          <div v-for="template in $root.templates.data" v-if="!!template.image" class="col-lg-3 col-md-4 col-6">
            <a @click="selectTemplateImage(template)" href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail " :src="template.image.url" alt="">
            </a>
          </div>
      </div>
      <div v-else class="row text-center p-5 justify-content-center">
        <i class="far fa-folder-open fa-5x p-2"></i> <br>
        <h4>We don't have templates available for this. You can upload your own design by clicking <span class="font-weight-bold">Upload image</span> button above. </h4>
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
