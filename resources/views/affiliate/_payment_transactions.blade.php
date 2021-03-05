
<div class="row mt-3">
    <div class="col-md-12">
        <h2> {{ $pageTitle ?? 'Transactions' }}
        </h2>
        @include('helpers._flash')
    </div>
</div>
<div class="row ">
  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr class="table-secondary">
            <th>#</th>
            <th>Transaction</th>
            <th>Order</th>
            <th>Date</th>
            <th class="text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @forelse($bills as $bill)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$bill->transaction_type->name}}</td>
            <td>{{$bill->order_id}}</td>
            <td>{{$bill->created_at}}</td>
            <td class="text-right">₹
              <?= $user->id == $bill->creditor_id ? '-' : '' ?>
              {{round($bill->amount,2)}}</td>

          </tr>
          @empty
            No transactions yet.
          @endforelse
        </tbody>
      </table>
    </div>
    {{$bills->links()}}
  </div>

</div>
