<!-- payment summary -->
<div class="row ">
  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Level 1</th>
            <th>Level 2</th>
            <th>Level 3</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Referrals</td>
            <td> {{$referral_count['level1']}}  </td>
            <td> {{$referral_count['level2']}}  </td>
            <td> {{$referral_count['level3']}}  </td>
            <td class="font-weight-bold"> {{$referral_count['total']}}  </td>
          </tr>

          <tr>
            <td>Total Earnings</td>
            <td> ₹ {{$commision['level1']}}  </td>
            <td> ₹ {{$commision['level2']}}  </td>
            <td> ₹ {{$commision['level3']}}  </td>
            <td class="font-weight-bold"> ₹ {{$commision['total']}}  </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
