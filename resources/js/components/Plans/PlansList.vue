<template>
    <div class="plan__container">
        <slot></slot>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  name: "PlansList",
  props: ["plans", "firm_types", "firms", "yearDiscount", "firmId", "futurePlans"],
  data() {
    return {
      formStep: 1,
      selectedTags: [],
      slab_selected: [],
      is_trial_selected: 1,
      duration_selected: 3,
      firm_id: !!this.firmId ? this.firmId : (!!this.firms ? this.firms[0].id : ''),
      localPlans: this.plans
        // services: this.plans.filter(el => !!el.is_post_plan == false)
      // rulesAdded: !!this.rules.length ||  true
    };
  },
  computed: {
      totalPlanAmount: function() {
          let total = 0;
          this.localPlans.filter(el => {
              if(el.is_selected == true && this.duration_selected > 0) total += el.finalRate;
          });
          return total.toFixed(2);
      }
  },
  methods: {
    changeDuration(duration) {
      this.duration_selected = duration;
      this.calculatePlanRates();
    },
    calculatePlanRates() {
      this.localPlans.filter(el => {
        let rate = el.rate;
        if(el.id == 4) { // firm plan
          rate = this.firm_types.find(ft => ft.id == el.firm_type_id).rate;
        }
        let discount = (this.duration_selected == 12 && this.yearDiscount > 0) ? (rate*this.yearDiscount/100): 0;

        el.mrp = rate*el.slab_selected;
        el.finalRate = (rate - discount)*el.slab_selected;
        el.discount = discount*el.slab_selected;
        return el;
      })
    },
    onFirmChange(event, plan) {
        if(!!event)
        {
            // let index = this.localPlans.findIndex(el => el.id == plan.id);
            // this.localPlans[index].firm_type_id = event.target.value;

            this.localPlans = this.localPlans.filter(el => {
              if(el.id == plan.id) el.firm_type_id = event.target.value;
              return el;
            });
            this.calculatePlanRates();

        }
    },

    selectPlan(plan, value) {
        this.localPlans = this.localPlans.filter(el => {
          if(el.id == plan.id) el.is_selected = value;
          return el;
        });
    },

    changeSlab(event, plan) {
        this.localPlans = this.localPlans.filter(el => {
          if(el.id == plan.id) el.slab_selected = parseFloat(event.target.value);
          return el;
        });
        this.calculatePlanRates();
    },

    submitForm() {
        console.log("Submit Form", this.localPlans);
        axios.post('/plans', this.localPlans).then(response => {
            console.log("Submited: ",response);
        })
    },
    initLocalPlans() {
      this.localPlans = this.localPlans.filter(el => {
                          let index = !!this.futurePlans ? this.futurePlans.findIndex(fp => fp.plan_id == el.id) : -1;
                          el.is_selected = index >= 0 ? true : false ;
                          el.slab_selected = el.is_slab_in_months ? 0.5 : 1;
                          if(el.id == 4) el.firm_type_id = 1;
                            return el;
                        })
    }
  }, // methods
  mounted() {
    this.initLocalPlans();
    this.calculatePlanRates();
  }
};
</script>

<style lang="css" scoped>

</style>
