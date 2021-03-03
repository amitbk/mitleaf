@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => $firm->name, 'logo' => $firm->logo ] )

    <div class="row justify-content-center">
        <div class="col-md-9 col-xs-12 mt-3 justify-content-center">
            @include('helpers._flash')

            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    @if($firm->plans->count() == 0 )
                        <!-- if no plan, ask to purchase plan -->
                        <div class="card text-center mb-3">
                          <div class="card-body">No any plans active, please buy any plan.
                              <br>
                            <a href="{{route('plans.index')}}" class="btn btn-primary">View Plans</a>
                          </div>

                        </div>
                    @endif


                    <div class="card">
                      <div class="card-header">
                        Facebook page connection
                      </div>
                      <div class="card-body">
                        @if($firm->social_networks->first())
                        Your post will be posted on this page:
                        <div class="font-weight-bold">
                          {{$firm->social_networks->first()->name ?? 'Not selected'}}
                        </div>

                        <br> You can change, on which page we should publish scheduled posts.
                        @else
                          Please select page here to publish posts.
                        @endif
                        <hr>

                        <form class="" action="{{url('firms/update_fb_page')}}" method="post">
                          @csrf
                          <input type="hidden" name="firm_id" value="{{$firm->id}}">
                          <div class="form-group">
                            <label for="pages">Select a page to publish created post on:</label>
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

                    <div class="card my-2 text-center">
                        <div class="card-body">
                            Update firm details
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
