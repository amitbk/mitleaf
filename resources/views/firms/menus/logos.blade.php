<div class="row justify-content-center">
  <div class="col-12">
    <h4 class="mb-4">Logos</h4>

  </div>
    <div class="col-md-6">
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
      <div class="col-md-6">

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
</div>
