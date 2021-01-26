<template>
  <div>
    Edit Post Image
    <!-- <button @click="processDone">Done</button> -->
    <img :src="$root.post.templateImageUrl" alt="Template image" class="img-fluid">
  </div>
</template>

<script>
export default {

  methods: {
    processDone() {
      this.$emit('process-done', 2);
    }
  }
}
</script>

<style>

</style>
