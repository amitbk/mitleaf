<div class="card shadow mb-2">
  <div class="card-body">
    <h4>Connect Page to Business</h4>
    <form class="" action="{{url('firms/update_fb_page')}}" method="post">
      @csrf
      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <label for="firms">Business Name:</label>
            <select name="firm_id" class="form-control" id="firms">
              @foreach($user->firms as $firm)
                <option value="{{$firm->id}}">{{$firm->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label for="pages">Select a page to post updates:</label>
            <select name="social_network_id" class="form-control" id="pages">
              @foreach($user->social_networks as $social_network)
                <option value="{{$social_network->id}}">{{$social_network->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label class="text-white w-100">#</label>
            <button type="submit" name="button" class="btn btn-primary ">Update</button>
          </div>

        </div>
      </div>
      Post of business will be posted on connected page only.

    </form>

  </div>
</div>
