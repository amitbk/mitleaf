<posts :plans="{{ $plans }}" :firm_types="{{$firm_types}}" inline-template>
  <div class="posts__wrapper">

    <button type="button" class="btn btn-primary" @click="$bvModal.show('modalNewPost')">
      New Post
    </button>
    <post-create/>

    @{{dates}}
    <div v-for="(date, i) in dates">
      <div class="post__wrapper mb-3">
        <div class="post_date py-3">
          <span class="font-weight-bold "> @{{ date.label }}</span>
          <span class="text-secondary">@{{ !!date.posts ? Object.keys(date.posts).length : '0' }} posts</span>
          <button v-if="false" type="button" class="btn btn-sm btn-outline-primary float-right">Add Post</button>
        </div>

        <!-- <transition-group name="fade" tag="div" > -->
          <div :key="$uuid.v1()" v-for="(post, index) in date.posts">
            <post :post="post" :dateIndex="i" :index="index"
              @delete-post="deletePost" />
          </div>
        <!-- </transition-group> -->

        <div v-if="!!date.posts == false || Object.keys(date.posts).length == 0" class="bg-lightcyan2 p-2 text-center text-secondary">
          No posts for this day.
        </div>

      </div>
    </div>

  </div>
</posts>
