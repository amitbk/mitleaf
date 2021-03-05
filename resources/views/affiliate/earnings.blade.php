@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">

          <div class="row">
            <div class="col-sm-12">

              <div class="card">
                <div class="card-body shadow">
                  <div class="text-center">
                    <i class="fas fa-wallet fa-4x"></i>
                    <h2 class="font-weight-bold my-2">Your Earnings</h2>

                    <div>Share this link to reffer a new user</div>
                    @include('affiliate._affiliate_link', ['user' => $user]);

                  </div>

                  @include('helpers._flash')


                  <hr>
                  <div class="text-center">
                    <div class="">
                      Your pending payment is
                    </div>
                    <h2>₹ {{$user->wallet()}}</h2>
                  </div>

                  <hr>

                  @include('affiliate._payment_summary', ['referral_count' => $referral_count, 'commision' => $commision])


                </div>
              </div>

            </div>
          </div>
          @include('affiliate._payment_transactions', ['bills' => $bills, 'user' => $user])

        </div>
    </div>
</div>
@endsection
