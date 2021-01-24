<template>
  <div class="posts__wrapper">
    <div v-for="i in 30">
      <Post />
    </div>
  </div>
</template>

<script>
import Post from "./Post";
export default {
  components: {
    Post
  }
}
</script>

<style>

</style>
