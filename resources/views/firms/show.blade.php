@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => $firm->name, 'title2' => $firm->firm_type->name ?? '',
                                      'logo' => $firm->logo,
                                      'bg_class' => 'fl_bg_gray'
                                      ] )


<section class="header">
  <div class="container py-4">
      <div class="row">
        <div class="col-12">
          @include('helpers._flash')
        </div>
      </div>

      <div class="row">
              <div class="col-md-3">
                  <!-- Tabs nav -->
                  <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link mb-3 p-3 shadow {{!request()->has('tab') || request()->tab == 'home' ? 'active' : ''}}" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                          <i class="fa fa-tachometer-alt mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Overview</span></a>

                      <a class="nav-link mb-3 p-3 shadow {{request()->tab == 'logos' ? 'active' : ''}}" id="v-pills-logos-tab" data-toggle="pill" href="#v-pills-logos" role="tab" aria-controls="v-pills-logos" aria-selected="false">
                          <i class="fa fa-images mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Logos</span></a>

                      <a class="nav-link mb-3 p-3 shadow {{request()->tab == 'social-media' ? 'active' : ''}}" id="v-pills-social-media-tab" data-toggle="pill" href="#v-pills-social-media" role="tab" aria-controls="v-pills-social-media" aria-selected="false">
                          <i class="fa fa-share-alt-square mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Social Media</span></a>

                      <!-- <a class="nav-link mb-3 p-3 shadow {{request()->tab == 'settings' ? 'active' : ''}}" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                          <i class="fa fa-check mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Settings</span></a> -->

                      <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" href="{{url('myplans?firm='.$firm->id)}}" >
                         <i class="fa fa-check mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Active Plan <i class="fa fa-external-link-alt"></i> </span></a>

                      <a class="nav-link mb-3 p-3 shadow" href="#!" class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#deleteFirm">
                          <i class="fa fa-trash mr-2"></i>
                          <span class="font-weight-bold small text-uppercase">Delete Business</span></a>


                      </div>
              </div>


              <div class="col-md-9">
                  <!-- Tabs content -->
                  <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade shadow rounded bg-white {{ !request()->has('tab') || request()->tab == 'home' ? 'active show' : ''}} p-3" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                          @include('firms.menus.overview')
                      </div>

                      <div class="tab-pane fade shadow rounded bg-white p-3 {{request()->tab == 'logos' ? 'active show' : ''}}" id="v-pills-logos" role="tabpanel" aria-labelledby="v-pills-logos-tab">
                        @include('firms.menus.logos')
                      </div>

                      <div class="tab-pane fade shadow rounded bg-white p-3 {{request()->tab == 'social-media' ? 'active show' : ''}}" id="v-pills-social-media" role="tabpanel" aria-labelledby="v-pills-social-media-tab">
                        @include('firms.menus.social_media')
                      </div>

                      <div class="tab-pane fade shadow rounded bg-white p-3 {{request()->tab == 'settings' ? 'active show' : ''}}" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        @include('firms.menus.settings')
                      </div>



                      @include('firms.menus.delete_business')


                  </div>
              </div>
          </div>
      </div>
  </section>

</div>
@endsection
