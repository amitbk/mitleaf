<h4 class="mb-4">Overview of {{$firm->name}}</h4>

<div class="row">
  <div class="col-12">
    @include('helpers._flash')
  </div>
  @if($user->social_networks()->count() == 0)
  <div class="col-12">
    <div class="alert alert-success d-flex">
      You havent connected pages yet to auto publish on Facebook
      <a href="{{url('/facebook/connect_pages')}}" class="btn btn-outline-primary ml-auto font-weight-bold">Connect New Pages</a>
    </div>
  </div>
  @endif

  @if($firm->plans->count() == 0 )
    <div class="col-12">
      <!-- if no plan, ask to purchase plan -->
      <div class="card text-center mb-3">
        <div class="card-body">No any plans active, please invest in any plan to start brand building of <span class="font-weight-bold">{{$firm->name}}</span>.
            <br><br>
          <a href="{{route('plans.index')}}" class="btn btn-primary">View Plans</a>
        </div>

      </div>
    </div>
  @endif

</div>
