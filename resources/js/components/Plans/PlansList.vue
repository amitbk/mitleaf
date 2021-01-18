<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "PlansList",
  props: ["plans", "firm_types", "firms"],
  data() {
    return {
      formStep: 1,
      selectedTags: [],
      slab_selected: [],
      is_trial_selected: 1,
      duration_selected: 3,
      firm_id: !!this.firms ? this.firms[0].id : '',
      localPlans: this.plans.filter(el => {
                        el.is_selected = false;
                        el.slab_selected = el.is_slab_in_months ? 0.5 : 1;
                        if(el.id == 4) el.firm_type_id = 1;
                          return el;
                  }),
      yearDiscount: 15
        // services: this.plans.filter(el => !!el.is_frame_plan == false)
      // rulesAdded: !!this.rules.length ||  true
    };
  },
  computed: {
      getFirmTypeRate: function() {
          let thisPlan = this.localPlans.find(el => el.id == 4);
          let firmRate = this.firm_types.find(el => el.id == thisPlan.firm_type_id).rate;
          let slab = this.localPlans.find(el => el.id == 4).slab_selected;
          thisPlan.rate = firmRate - (this.duration_selected == 12 ? (firmRate*this.yearDiscount/100): 0);
          let rate = thisPlan.rate*slab;
          return rate;
      },
      totalPlanAmount: function() {
          let total = 0;
          this.localPlans.forEach(el => {
              if(el.is_selected == true) total += el.rate*el.slab_selected
          });
          return total;
      }
  },
  methods: {

    onFirmChange(event, plan) {
        if(!!event)
        {
            let index = this.localPlans.findIndex(el => el.id == plan.id);
            this.localPlans[index].firm_type_id = event.target.value;
        }
    },

    selectPlan(plan, value) {
        console.log("as");
        let index = this.localPlans.findIndex(el => el.id == plan.id);
        this.localPlans[index].is_selected = value;
    },

    submitForm() {
        console.log("Submit Form", this.localPlans);
        axios.post('/plans', this.localPlans).then(response => {
            console.log("Submited: ",response);
        })
    }
}, // methods
};
</script>

<style lang="css" scoped>

</style>
