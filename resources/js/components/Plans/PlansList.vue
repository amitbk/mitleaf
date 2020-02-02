<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
export default {
  name: "PlansList",
  props: ["plans", "firm_types"],
  data() {
    return {
      selectedTags: [],
      firm_type_id: 1,
      slab_selected: [],
      localPlans: this.plans.map(el => {
                    // if event type,slab=1 else 2
                    el.id == 3 ? el.slab = 1 : el.slab = 2;
                      return el;
                  })
      // rulesAdded: !!this.rules.length ||  true
    };
  },
  computed: {
      getFirmTypeRate: function() {
          console.log(this.localPlans.find(el => el.id == 4));
          return this.firm_types.find(el => el.id == this.firm_type_id).rate/this.localPlans.find(el => el.id == 4).slab;
      }
  },
  methods: {
    onSlabChange(event, plan) {
        if(!!event)
        {
            console.log(event.target.value, plan.id);
            let index = this.localPlans.findIndex(el => el.id == plan.id);
            this.localPlans[index].slab = event.target.value;
        }

    }
      // childTags(tagId) {
      //     return this.tags.filter(el => el.tag_id == tagId);
      // },
      // onTagClick(tag) {
      //       let index = this.selectedTags.findIndex(el => el.id == tag.id);
      //       if(index < 0)
      //           this.selectedTags.push(tag);
      // }
  }
};
</script>

<style lang="css" scoped>

</style>
