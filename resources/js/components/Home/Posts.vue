<template>
  <div class="posts__wrapper">

    <div v-for="(date, index) in dates">

      <div class="post__wrapper mb-3">
        <div class="post_date py-3">
          <span class="font-weight-bold "> {{ date.label }}</span>
          <span class="text-secondary">2 posts</span>
          <button type="button" class="btn btn-sm btn-outline-primary float-right">Add Post</button>
        </div>


        <div v-for="post in date.posts">
          <Post :post="post"/>
        </div>

        <div v-if="!!date.posts == false" class="bg-lightcyan2 p-2 text-center text-secondary">
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
    getDateLabel(index, date) {
      if(index == 0) return "Today";
      if(index == 1) return "Tomorrow";
      return timeData.days[date.getMonth()] + ", " + date.getDate() + " " + timeData.months[date.getMonth()] + ", "+ date.getFullYear();
    },

    getPosts(date) {
      console.log("55", date.ymd, this.posts[date.ymd] );
      return this.posts[date.ymd];
    },

    createDateObject() {
      // find next 30 days craete create object
      let today = new Date()
      for (let i = 0; i < 30; i++) {
        let el = {};
        el.date = new Date( new Date().setDate(today.getDate()+i) );
        el.ymd = el.date.toISOString().split('T')[0]; // Y-m-d
        el.label = this.getDateLabel(i, el.date);
        el.posts = {};
        this.dates.push( el );
      }
    },

    getPostsAndAttachToDate() {
      let data = {firm_id: 2};
      postServices.getPosts(data).then(res => {
        let posts = res.data;

        // add posts to local data by date group
        posts.filter(el => {
          let post_date = el.schedule_on.split(' ')[0]
          if(!this.posts[post_date])
            this.posts[post_date] = [];

          this.posts[post_date].push(el);
        })

        // add posts to local date object
        this.dates.filter(el => {
          el.posts = this.posts[el.ymd];
          return el;
        })

      })
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
