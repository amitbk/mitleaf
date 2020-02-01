<template>
    <div class="tag__container">
        <slot></slot>
    </div>
</template>

<script>
export default {
  name: "SelectTags",
  props: ["tags"],
  data() {
    return {
      amit: "Amit Kadam"
    };
  },

  methods: {
  }
};
</script>

<style lang="css" scoped>

</style>
