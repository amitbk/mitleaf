@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">

            @if($plans->count() == 0)
                <h2>You dont have any active plan.</h2>
            @else
            <table class="table table-bordered">
                <thead>
                  <tr>
``                  <th>#</th>
                    <th class="text-left">Name</th>
                    <th>Qty/Month</th>
                    <th>Scheduled On</th>
                    <th>Expiry</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach($plans as $plan)
                      <tr>
                        <td>{{$no++}}</td>
                        <td class="text-left">
                            <div class="font-weight-bold">{{$plan->plan->name}}</div>
                            {{$plan->firm_type->name ??''}}
                        </td>
                        <td>{{$plan->qty_per_month}}</td>
                        <td>{{$plan->date_scheduled->format('d M,Y')}}</td>
                        <td>{{$plan->date_expiry->format('d M,Y')}}</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              @endif
        </div>
    </div>

</div>
@endsection
