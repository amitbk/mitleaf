@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="text-center font-weight-bold">{{$firm->name}}</h3>
                @include('helpers._flash')
                <div class="card">
                    <div class="card-body text-center">

                      <h4 class="text-center">Add facebook pages to publish your posts</h4>

                      <a href='{{url("/facebook/connect_pages?redirect=/firms/$firm->id/add_fb_page")}}' class="btn btn-primary ml-auto font-weight-bold my-3">Connect New Pages</a>


                      <hr>
                      <div class="text-center">
                        OR
                      </div>

                      <form class="" action="{{url('firms/update_fb_page?redirect=plans')}}" method="post">
                        @csrf
                        <input type="hidden" name="firm_id" value="{{$firm->id}}">


                        <label for="demo">Select a page to publish created post on:</label>
                        <div class="input-group mb-3">
                            <select name="social_network_id" class="form-control" id="pages">
                              @foreach($user->social_networks as $social_network)
                                <option value="{{$social_network->id}}">{{$social_network->name}}</option>
                              @endforeach
                            </select>
                            <div class="input-group-append">
                              <button type="submit" name="button" class="btn btn-primary">Update</button>
                            </div>
                         </div>


                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
