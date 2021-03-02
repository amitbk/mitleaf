<template>
  <div class="post__wrapper">
    <div class="card mb-3 shadow">
      <div class="card-body p-1">
          <div class="row">
            <div class="col-12 col-sm-3 mb-2 mb-sm-0 text-center">
              <img v-if="!!localPost.image" class="img-fluid" :src="'/'+localPost.image.url" alt="">
              <div v-else class="text-secondary py-4 f-12">
                Frame is not generated yet. WIll be generated 8 days before scheduled day.
              </div>
              <!-- <image-preview class="card__image img-fluid h-100 w-100 pr-3 pr-sm-0" :image="localPost.image" no-image-msg="No post created yet."/> -->

            </div>
            <div class="col-12 col-sm-9">
              <div class="d-flex">
                <div class="font-weight-bold">
                  {{localPost.title}}
                </div>
                <div class="ml-auto">
                  <!-- plan name: Business | Indian Event | Quotes -->
                  <span class="fl_tag bg_sky1">{{post.firm_plan.plan.name}}</span>
                  <!-- Sub type: Hospital | Event Name -->
                  <span v-if="post.firm_plan.firm_type_id" class="fl_tag">{{post.firm_plan.firm_type.name}}</span>
                  <span v-if="!!post.event" class="fl_tag">{{post.event.name}}</span>

                  <button v-if="!!localPost.image" type="button" class="btn btn-sm btn-outline-primary">Download</button>
                </div>
              </div>

              <div class="post__content">
                {{localPost.content}}
              </div>
            </div>
          </div>
      </div>
      <div class="card-footer p-1 ">
        <div class="row align-items-center">
          <div class="col-12 col-sm-6 text-secondary f-12">
            <i class="fas fa-clock"></i> Scheduled on 10:11 PM (GMT+5.30)
          </div>
          <div class="col-12 col-sm-6 text-right">
              <button type="button" class="btn btn-sm btn-outline-info" @click="onRecreatePostClick">Recreate</button>
              <button type="button" class="btn btn-sm btn-outline-danger" @click="$emit('delete-post', {id: localPost.id, dateIndex: dateIndex, index: index })">Delete</button>
              <!-- <button type="button" class="btn btn-sm btn-outline-primary">Edit</button> -->
              <button v-if="!!localPost.image" type="button" class="btn btn-sm btn-primary">Share Now</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ['post', 'dateIndex', 'index'],
  data() {
    return {
        localPost: this.post,
    };
  },
  methods: {
      onRecreatePostClick() {

          axios.post('/recreate_post', this.localPost).then(res => {
              this.localPost = res.data;
          })
      }
  }, // methods
}
</script>

<style>

</style>
