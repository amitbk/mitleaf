@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center mb-3">
        <div class="col-md-8 text-center">
                <h3 class="font-weight-bold">{{$firm->name}}</h3>

                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-left">Amount</th>
                        <th class="text-left">Plans</th>
                        <th>Start Date</th>
                        <th>Expiry</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;?>
                        @foreach($firm->orders as $order)
                          <tr>
                            <td>{{$no++}}</td>
                            <td class="text-left">
                                <div class="font-weight-bold">₹{{$order->amount}}</div>
                            </td>
                            <td class="text-left">
                              @foreach($order->plans as $order_plan)
                                {{$order_plan->plan->name}} <br>
                              @endforeach
                            </td>
                            <td>{{$order->date_start_from->format('d M,Y')}}</td>
                            <td>{{$order->date_expiry->format('d M,Y')}}</td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
        </div>
    </div>

</div>
@endsection
