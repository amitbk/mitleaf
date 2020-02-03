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
      slab_selected: [],
      localPlans: this.plans.map(el => {
                    // if event type,slab=1 else 2
                    el.id == 3 ? el.slab = 1 : el.slab = 2;
                    if(el.id == 4) el.firm_type_id = 1;
                      return el;
                  })
      // rulesAdded: !!this.rules.length ||  true
    };
  },
  computed: {
      getFirmTypeRate: function() {
          let thisPlan = this.localPlans.find(el => el.id == 4);
          return this.firm_types.find(el => el.id == thisPlan.firm_type_id).rate/this.localPlans.find(el => el.id == 4).slab;
      }
  },
  methods: {
    onSlabChange(event, plan) {
        if(!!event)
        {
            let index = this.localPlans.findIndex(el => el.id == plan.id);
            this.localPlans[index].slab = event.target.value;
        }

    },
    onFirmChange(event, plan) {
        if(!!event)
        {
            let index = this.localPlans.findIndex(el => el.id == plan.id);
            this.localPlans[index].firm_type_id = event.target.value;
        }
    },
}, // methods
};
</script>

<style lang="css" scoped>

</style>
