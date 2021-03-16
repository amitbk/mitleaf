@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
          <h2 class="font-weight-bold">Your plans</h2>


          <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              @forelse($firms as $key => $firm)
                <li class="nav-item">
                  <a class="nav-link font-weight-bold <?php echo ($key == 0 && !$firm_id) || $firm_id == $firm->id ? 'active' : ''; ?>" data-toggle="tab" href="#home{{$firm->id}}">{{$firm->name}}</a>
                </li>
              @empty
                No firms added yet.
              @endforelse
            </ul>
            <!-- Tab panes -->
            <div class="tab-content mt-3">
              @foreach($firms as $key => $firm)
                <div class="tab-pane container <?php echo ($key == 0 && !$firm_id) || $firm_id == $firm->id ? 'active' : ''; ?>" id="home{{$firm->id}}">
                  @if($firm->future_plans()->count() == 0)
                      <div class="text-center p-5 justify-content-center">
                        <i class="fas fa-plane-slash fa-5x p-4"></i> <br>
                        <h4>You dont have any active plan for {{$firm->name}}. </h4>

                        <a href="{{url('plans?firm_id='.$firm->id)}}" class="btn btn-success">Buy a Plan</a>
                      </div>
                  @else
                  <div class="d-flex py-2">
                    <div class="font-weight-bold text-primary">
                      Expiring on {{ $firm->date_expiry() }}
                    </div>
                    <div class="ml-auto">
                      <a href="{{url('plans?firm_id='.$firm->id)}}" class="btn btn-success">Renew Plan</a>
                    </div>
                  </div>
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="text-left">Name</th>
                          <th class="text-left">Order Id</th>
                          <th>Qty/Month</th>
                          <th>Scheduled On</th>
                          <th>Expiry</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $no=1;?>
                          @foreach($firm->future_plans() as $plan)
                            <tr>
                              <td>{{$no++}}</td>
                              <td class="text-left">
                                  <div class="font-weight-bold">{{$plan->plan->name}}</div>
                                  <div>{{$plan->firm_type->name ??''}} </div>

                                  @if($plan->is_trial)
                                   <div class="badge badge-pill badge-primary">Trial Plan</div>
                                  @endif
                              </td>
                              <td>ML{{$plan->order_plan->order_id}}</td>
                              <td>{{$plan->qty_per_month}}</td>
                              <td>{{$plan->date_start_from->format('d M,Y')}}</td>
                              <td>{{$plan->date_expiry->format('d M,Y')}}</td>
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                    @endif
                </div>
              @endforeach

            </div>
        </div>
    </div>

</div>
@endsection
