@extends('layouts.app')

@section('content')
<create-rule :tags="{{$tags}}" :rules="{{$rules}}" inline-template>
    <div class="container">

        <div v-if="false" class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header  text-center">You haven't created rules to create your frames automatically.</div>
                      <div class="card-body">
                        <!-- <img src="{{asset('images/icons/chosen.svg')}}" class="img-responsive" alt=""> -->
                        <p class="card-text">You can set default what type of frames (images) you need to generate.
                            <br><br>
                            Eg. If you need daily images for good thougths and images for each special indian event, you can set rules and we will handle next part.
                            <br><br>
                            We will create images for you and will send you on your default email.
                            <br><br>
                            So, let's start?
                        </p>
                        <a href="#" class="btn btn-primary">Create a Plan</a>
                      </div>
                </div>
             </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-8 text-center">
                <h3>Select best plans to continue</h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                      <div class="text-center font-weight-bold">
                        Daily thougths
                        <!-- <a href="{{ route('tags.create')}}" class="btn btn-success btn-sm">Add New</a> -->
                      </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="text-center">
                            <h3>₹290/month</h3>
                        </div>
                        <div class="mb-3">
                            We will create Inspirational images, Daily thougths images for you with your business name
                        </div>
                        <div class="mt-auto">
                            <div class="form-group">
                                <label for="sel1">Select Plan Type:</label>
                                <select class="form-control" id="sel1">
                                    <option>15 Images/Month</option>
                                    <option>30 Images/Month</option>
                                </select>
                            </div>
                            <!--
                            <button type="button" class="btn btn-default border border-secondary btn-block">15 Images/Month</button>
                            <button type="button" class="btn btn-default border border-secondary btn-block">30 Images/Month</button> -->
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                      <div class="text-center font-weight-bold">
                        All Indian Events
                        <!-- <a href="{{ route('tags.create')}}" class="btn btn-success btn-sm">Add New</a> -->
                      </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="text-center">
                            <h3>₹220/month</h3>
                        </div>
                        <div class="mb-3">
                            We will create special images for you on each event or festival of India.
                            Like Republican day, Diwali, Independence day, Workers Day or birthday of some well known person.
                        </div>

                        <div class="mt-auto mb-3">
                            <button type="button" class="btn btn-default border border-secondary btn-block">Rs.250/Month</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                      <div class="text-center font-weight-bold">
                          Business Specific Images
                      </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="text-center">
                            <h3>₹620/month</h3>
                        </div>

                        <div class="mb-3">
                            If are running a busines, we will create speciafic images for your business.
                            Eg. For Hospitals, we will create health related images,
                            <br> For Hotels, we will create eating habbits related images
                        </div>
                        <div class="row mt-auto justify-content-center">
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
    </div>
</create-rule>
@endsection
