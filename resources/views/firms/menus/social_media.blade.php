<div class="row justify-content-center">

  @if(1 || $user->social_networks()->count() > 0)
  <div class="col-md-12 mb-4">
      <div class="d-flex">
        <h4>Connected facebook page for {{$firm->name}}</h4>
        <div class="ml-auto">
          <a href="{{url('social_networks')}}" class="btn btn-outline-primary">All Pages</a>
        </div>
      </div>
          @if(1 || $firm->social_networks->first())
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
  @endif

</div>
