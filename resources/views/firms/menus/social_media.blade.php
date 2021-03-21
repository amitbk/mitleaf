<div class="row justify-content-center">

  @if(1 || $user->social_networks()->count() > 0)
  <div class="col-md-12 mb-4">
      <div class="d-flex">
        <h4>Connected facebook page for {{$firm->name}}</h4>
        <div class="ml-auto">
          <a href="{{url('social_networks')}}" class="btn btn-outline-primary">All Pages</a>
        </div>
      </div>


          <form class="" action="{{url('firms/update_fb_page')}}" method="post">
            @csrf
            <input type="hidden" name="firm_id" value="{{$firm->id}}">
            <input type="hidden" name="redirect" value="firm">

            <label for="pages">Select/change a page to publish scheduled posts:</label>

            <div class="input-group mb-3">

              <select name="social_network_id" class="form-control" id="pages">
                <option value="0">Select</option>
                @foreach($user->social_networks as $social_network)
                  <option value="{{$social_network->id}}" {{$firm->social_networks->first()->id ?? 0 == $social_network->id ? 'selected' : ''}}>{{$social_network->name}}</option>
                @endforeach
              </select>

              <div class="input-group-append">
                <button type="submit" name="button" class="btn btn-primary">Update</button>
              </div>
            </div>

          </form>

  </div>
  @endif

</div>
