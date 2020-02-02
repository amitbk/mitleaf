<template>
    <div class="tag__container">
        <slot></slot>
    </div>
</template>

<script>
export default {
  name: "CreateRule",
  props: ["tags", "rules"],
  data() {
    return {
      amit: "Amit Kadam",
      selectedTags: [],
      rulesAdded: !!this.rules.length ||  true
    };
  },
  computed: {
      parentTags: function() {
          return this.tags.filter(el => el.tag_id == null);
      }
  },
  methods: {
      childTags(tagId) {
          return this.tags.filter(el => el.tag_id == tagId);
      },
      onTagClick(tag) {
            let index = this.selectedTags.findIndex(el => el.id == tag.id);
            if(index < 0)
                this.selectedTags.push(tag);
      }
  }
};
</script>

<style lang="css" scoped>

</style>
