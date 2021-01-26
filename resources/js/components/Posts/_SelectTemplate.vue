<template>
  <div class="template__wrapper">
    <div class="font-weight-bold d-flex">
      <div>
        Select Template
      </div>

      <div class="form-group ml-2">
        <select @change="getTemplates($event)" class="form-control form-control-sm" id="category">
          <option value="0">Select Type</option>
          <option :value="plan.id" v-for="plan in $root.mitleaf.plans.filter(el => !!el.is_post_plan)">{{plan.name}}</option>
        </select>

      </div>


    </div>

      <hr>

      <div class="row text-center text-lg-left">

        <div class="col-lg-3 col-md-4 col-6 text-center pt-3">

          <button class="btn btn-outline-primary">
            <div><i class="fas fa-cloud-upload-alt fa-3x"></i></div>
            Upload your design</button>
        </div>

        <template v-for="template in $root.templates.data">
          <div v-if="!!template.image" class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" :src="template.image.url" alt="">
            </a>
          </div>
        </template>


      </div>


    <!-- https://picsum.photos/200/300 -->
  </div>
</template>

<script>
export default {
  methods: {
    getTemplates: function (ev) {
      this.$emit('get-templates', { filters: { plan_id: ev.target.value } } );
    }
  }
}
</script>

<style>

</style>
