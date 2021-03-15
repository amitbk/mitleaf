<div class="row justify-content-center">


    <div class="col-md-4 mb-3" v-for="localPlan in localPlans.filter(el => !!el.is_post_plan == false)">
        <div class="card h-100">
            <div class="card-header border-bottom-0 bg_2">
              <div class="text-center font-weight-bold">
                <h3> @{{localPlan.name}}</h3>
              </div>
            </div>

            <div class="card-body d-flex flex-column bg_yl">
                <div class="text-center font-weight-bold">
                  <div class="f-20">₹ @{{ localPlan.finalRate }}/month</div>
                  <div class="text-success"> Saving ₹@{{ localPlan.discount }}/month </div>
                </div>
                <div class="mb-3">
                    @{{localPlan.desc}}
                </div>

                <div v-if="localPlan.id==3" class="mt-auto mb-3">
                    <button type="button" class="btn btn-default border border-secondary btn-block">Images for major events</button>
                </div>


                <div class="btn_selected">
                    <button @click="selectPlan(localPlan, false)" v-if="!!localPlan.is_selected" type="button" class="btn btn-success border border-secondary btn-block">Selected</button>
                    <button @click="selectPlan(localPlan, true)" v-else type="button" class="btn btn-default border border-secondary btn-block bg-white">Select this plan</button>
                </div>
            </div>
        </div>
    </div>

</div>
