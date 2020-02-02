<div class="row justify-content-center">


    <div class="col-md-4 mb-3" v-for="plan in plans">
        <div class="card h-100">
            <div class="card-header">
              <div class="text-center font-weight-bold">
                @{{plan.name}}
              </div>
            </div>

            <div class="card-body d-flex flex-column">
                <div class="text-center">
                    <h3>₹@{{plan.rate}}/month</h3>
                </div>
                <div class="mb-3">
                    @{{plan.desc}}
                </div>


                <div v-if="plan.id != 4 && plan.is_slab_in_months == 1" class="mt-auto">
                    <div class="form-group">
                        <label for="sel1">Select Plan Type:</label>
                        <select class="form-control" id="sel1">
                            <option>15 Images/Month</option>
                            <option>30 Images/Month</option>
                        </select>
                    </div>
                </div>

                <div v-if="plan.id==3" class="mt-auto mb-3">
                    <button type="button" class="btn btn-default border border-secondary btn-block">Rs.250/Month</button>
                </div>

                <!-- if Business Specific type -->
                <div v-if="plan.id==4" class="row mt-auto justify-content-center">
                    <div class="col-md-6 mt-auto">
                        <div class="form-group">
                          <label for="sel1">Select Plan Type:</label>
                          <select class="form-control" id="sel1">
                              <option>15 Images/Month</option>
                              <option>30 Images/Month</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-auto">
                        <div class="form-group">
                          <label for="sel1">Select Business:</label>
                          <select class="form-control" id="sel1">
                            <option>Hotel</option>
                            <option>Hospital</option>
                            <option>School</option>
                            <option>Garment Shop</option>
                          </select>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
