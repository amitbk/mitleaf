<div class="row justify-content-center">


    <div class="col-md-4 mb-3" v-for="localPlan in localPlans">
        <div class="card h-100">
            <div class="card-header">
              <div class="text-center font-weight-bold">
                @{{localPlan.name}}
              </div>
            </div>

            <div class="card-body d-flex flex-column">
                <div class="text-center">
                    <h3 v-if="localPlan.id != 4">₹@{{ localPlan.rate/localPlan.slab}}/month</h3>
                    <h3 v-else>₹@{{ getFirmTypeRate }}/month</h3>
                </div>
                <div class="mb-3">
                    @{{localPlan.desc}}
                </div>


                <div v-if="localPlan.id != 3 && localPlan.id != 4 && localPlan.is_slab_in_months == 1" class="mt-auto">
                        @include('plans._select_slab')
                </div>

                <div v-if="localPlan.id==3" class="mt-auto mb-3">
                    <button type="button" class="btn btn-default border border-secondary btn-block">Images for major events</button>
                </div>

                <!-- if Business Specific type -->
                <div v-if="localPlan.id==4" class="row mt-auto justify-content-center">
                    <div class="col-md-6 mt-auto">
                        @include('plans._select_slab')
                    </div>
                    <div class="col-md-6 mt-auto">
                        <div class="form-group">
                          <label for="sel1">Select Business:</label>
                          <select v-model="localPlan.firm_type_id" @change="onFirmChange($event, localPlan)" class="form-control" id="sel1">
                              <option v-for="firm_type in firm_types" :value="firm_type.id">@{{firm_type.name}}</option>
                          </select>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
