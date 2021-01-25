<template>
  <div class="posts__wrapper">

    <div v-for="(date, i) in dates">

      <div class="post__wrapper mb-3">
        <div class="post_date py-3">
          <span class="font-weight-bold "> {{ date.label }}</span>
          <span class="text-secondary">{{ !!date.posts ? Object.keys(date.posts).length : '0' }} posts</span>
          <button type="button" class="btn btn-sm btn-outline-primary float-right">Add Post</button>
        </div>

        <!-- <transition-group name="fade" tag="div" > -->
          <div :key="$uuid.v1()" v-for="(post, index) in date.posts">
            <Post :post="post" :dateIndex="i" :index="index"
              @delete-post="deletePost"/>
          </div>
        <!-- </transition-group> -->

        <div v-if="!!date.posts == false || Object.keys(date.posts).length == 0" class="bg-lightcyan2 p-2 text-center text-secondary">
          No posts for this day.
        </div>

      </div>
    </div>


    <!-- <div v-for="post in posts">
      <Post :post="post"/>
    </div> -->
  </div>
</template>

<script>
import Post from "./Post";
import postServices from "../../services/posts"
import timeData from "../../data/time"

export default {
  components: {
    Post
  },
  data () {
    return {
      dates: [],
      posts: {}
    }
  },
  methods: {

    getDateLabel(i, date) {
      if(i == 0 || i == 1) return ["Today", "Tomorrow"][i];
      return timeData.days[date.getMonth()] + ", " + date.getDate() + " " + timeData.months[date.getMonth()] + ", "+ date.getFullYear();
    },
    createDateObject() {
      // find next 30 days craete create object
      let today = new Date()
      for (let i = 0; i < 30; i++) {
        let el = {};
        el.date = new Date( new Date().setDate(today.getDate()+i) );
        el.ymd = el.date.toISOString().split('T')[0]; // = Y-m-d
        el.label = this.getDateLabel(i, el.date);
        el.posts = {};
        this.dates.push( el );
      }
    },

    getPostsAndAttachToDate() {
      let data = {firm_id: 2};
      postServices.getPosts(data).then(res => {
        this.posts = postServices.groupByDate(res.data);

        // add posts to local date object
        this.dates.filter(el => {
          el.posts = this.posts[el.ymd];
          return el;
        })

      })
    },

    deletePost(data) {
      postServices.deletePost(data.id).then(res => {
        this.getPostsAndAttachToDate();
      });
    }
  },
  mounted() {
    this.createDateObject();
    this.getPostsAndAttachToDate();
  }
}
</script>

<style>

</style>
