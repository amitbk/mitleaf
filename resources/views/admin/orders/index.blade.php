@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
            <h2><i class="fas fa-luggage-cart"></i> {{ $pageTitle ?? 'Orders' }}
            </h2>
        </div>
    </div>
    <div class="row ">
      <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="50px">#</th>
                  <th width="100px">Amount</th>
                  <th>Business</th>
                  <th width="80px">IsTrial</th>
                  <th width="80px">Status</th>
                  <th width="300px">Dates</th>
                </tr>
              </thead>

              <tbody>
                <?php $i=1;?>
                @forelse($orders as $order)
               <tr>
                 <td>{{$i++}}</td>
                 <td>₹{{$order->amount}}</td>
                 <td>
                    {{$order->firm->name}} <br>
                    <small> <i class="fas fa-user"></i> {{$order->user->name}}</small>
                 </td>
                 <td>{{$order->is_trial}}</td>
                 <td>
                   @if($order->status)
                   <span class="badge badge-success">Completed</span>
                   @else
                   <span class="badge badge-danger">Failed</span>
                   @endif
                 </td>
                 <td>Created: {{date('d M, Y h:i a', strtotime($order->created_at) )}}
                   @if(!!$order->date_expiry)
                   <br><small>Start: {{date('d M, Y', strtotime($order->date_start_from) )}}</small>
                   <br><small>Expiry: {{date('d M, Y', strtotime($order->date_expiry) )}}</small>
                   @endif
                 </td>
               </tr>
               @empty
                 No orders yet.
               @endforelse
             </tbody>
           </table>
        </div>


        </div>

    </div>
</div>
@endsection
