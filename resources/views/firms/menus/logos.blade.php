<div class="row justify-content-center">
  <div class="col-12">
    <h4 class="mb-4">Logos</h4>


    <div class="card mb-3">
      <div class="card-body">
        Select what should be added on your images

        <form class="" action="{{url('firms/'.$firm->id.'/logo_settings')}}" method="post">
          @csrf
          @foreach($firm->assets as $asset)
          <div class="form-check">
            <label class="form-check-label">
              <input name="assets[{{$asset->id}}]" type="checkbox" class="form-check-input" value="1" {{$asset->is_active ? 'checked' : '' }}> {{$asset->asset_type->name_display}}
            </label>
          </div>
          @endforeach

          <hr>

          <div class="form-check">
            <label class="form-check-label">
              <input name="add_logo_watermark" type="checkbox" class="form-check-input" value="1" {{$firm->add_logo_watermark ? 'checked' : '' }}> Add watermark of Logo on generated images
            </label>
          </div>

          <button type="submit" name="button" class="btn btn-primary mt-2">Update</button>
        </form>


      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card text-center shadow h-100">
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
      <div class="col-md-6 mb-3">

        <div class="card text-center shadow h-100">
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
</div>
