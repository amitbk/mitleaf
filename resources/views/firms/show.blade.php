@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => $firm->name, 'title2' => $firm->firm_type->name ?? '',
                                      'logo' => $firm->logo,
                                      'bg_class' => 'fl_bg_gray'
                                      ] )

    <div class="row justify-content-center">
        <div class="col-md-9 col-xs-12 mt-3 justify-content-center">
            <div class="row">
              @if($firm->plans->count() == 0 )
                <div class="col-12">
                  <!-- if no plan, ask to purchase plan -->
                  <div class="card text-center mb-3">
                    <div class="card-body">No any plans active, please buy any plan.
                        <br>
                      <a href="{{route('plans.index')}}" class="btn btn-primary">View Plans</a>
                    </div>

                  </div>
                </div>
                @endif

              <div class="col-12 col-sm-3 mb-2">
                <a href="{{route('firms.edit',$firm->id)}}" class="btn btn-outline-primary btn-sm btn-block">Edit</a>
              </div>
              <div class="col-12 col-sm-3 mb-2">
                <a href="{{url('myplans?firm='.$firm->id)}}" class="btn btn-outline-primary btn-sm btn-block">Active Plan</a>
              </div>
              <div class="col-12 col-sm-3 mb-2">
                <a href="{{url('social_networks')}}" class="btn btn-outline-primary btn-sm btn-block">Social Media Pages</a>
              </div>
              <div class="col-12 col-sm-3 mb-2">
                <a href="#!" class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#deleteFirm">Delete Business</a>
              </div>

            </div>

            <div class="modal" id="deleteFirm">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body text-center">
                    <h4>Are you sure to DELETE Business?</h4>

                    <div class="text-left">
                      <ul>
                        <li>If business has any active plan, you can't delete business.</li>
                        <li>Once deleted, all data related to business will be deleted.</li>
                      </ul>
                    </div>

                    <form action="{{route('firms.destroy', $firm->id)}}" class="form-delete ml-auto" method="post">
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger border_f" onclick="return confirm('This is second confirmation! Are you sure to delete business?')"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <hr>
            @include('helpers._flash')

            @if($user->social_networks()->count() == 0)
            <div class="alert alert-success d-flex">
              You havent connected pages yet to auto publish on Facebook
              <a href="{{url('/facebook/connect_pages')}}" class="btn btn-outline-primary ml-auto font-weight-bold">Connect New Pages</a>
            </div>
            @endif

            <div class="row justify-content-center">

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            @if($firm->logo)
                                <img class="img-fluid p-2" src="{{asset( $firm->logo ?? '' )}}" alt="">
                            @else
                                <div class="">
                                    No logo added.
                                </div>
                            @endif
                            <a href="{{route('firms.edit_assets', [$firm->id, 1] )}}" class="btn btn-primary"> {{$firm->logo ? 'Change' : 'Add'}} Logo</a>
                        </div>
                        <div class="card-footer">Logo</div>
                      </div>
                  </div>
                  <div class="col-md-4">

                    <div class="card my-2 text-center">
                        <div class="card-body">
                            @if($firm->strip())
                                <img class="img-fluid p-2" src="{{asset( $firm->strip() ?? '' )}}" alt="">
                            @else
                                <div class="">
                                    No strip added.
                                </div>
                            @endif
                            <a href="{{route('firms.edit_assets', [$firm->id, 3])}}" class="btn btn-primary"> {{$firm->strip() ? 'Change' : 'Add'}} Strip</a>
                        </div>
                        <div class="card-footer">Strip</div>
                    </div>


                </div>


                @if($user->social_networks()->count() > 0)
                <div class="col-md-4 mb-4">
                    <div class="card">
                      <div class="card-body">
                        @if($firm->social_networks->first())
                        <div class="text-primary">
                          Your post will be posted on this page:
                          <div class="font-weight-bold">
                            {{$firm->social_networks->first()->name ?? 'Not selected'}}
                          </div>
                        </div>
                        <div class="text-secondary">
                          You can change below,
                        </div>
                        @else
                        @endif

                        <form class="" action="{{url('firms/update_fb_page')}}" method="post">
                          @csrf
                          <input type="hidden" name="firm_id" value="{{$firm->id}}">
                          <div class="form-group">
                            <label for="pages">Select a page to publish scheduled posts:</label>
                            <select name="social_network_id" class="form-control" id="pages">
                              @foreach($user->social_networks as $social_network)
                                <option value="{{$social_network->id}}">{{$social_network->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <button type="submit" name="button" class="btn btn-primary">Update</button>

                        </form>
                      </div>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>
@endsection
