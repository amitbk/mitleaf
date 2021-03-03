@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Orders Status Cards -->
    <div class="row justify-content-center mt-3">

        <!-- new order -->
        <div class="col-md-3 mb-2">
            @include ("admin.dashboard._card1",
                          ['count' => 10, 'label' => 'New Orders',
                          'icon' => "fas fa-lightbulb",
                          'bg_class' => 'bg-success', 'text_class' => 'text-white'])
        </div>

        <!-- processing order -->
        <div class="col-md-3 mb-2">
            @include ("admin.dashboard._card1",
                          ['count' => 20, 'label' => 'Processing Orders',
                          'icon' => "fas fa-spinner fa-spin",
                          'bg_class' => 'bg-info', 'text_class' => 'text-white'])
        </div>

        <!-- On Hold Orders -->
        <div class="col-md-3 mb-2">
          @include ("admin.dashboard._card1",
                        ['count' => 30, 'label' => 'On Hold Orders',
                        'icon' => "fas fa-mug-hot",
                        'bg_class' => 'bg-warning', 'text_class' => 'text-body'])
        </div>

        <!-- completed orders -->
        <div class="col-md-3 mb-2">
          @include ("admin.dashboard._card1",
                        ['count' => 40, 'label' => 'Completed Orders',
                        'icon' => "fas fa-clipboard-check",
                        'bg_class' => 'bg-success', 'text_class' => 'text-body'])
        </div>


    </div>

    <div class="row py-4">

        <div class="col-3 col-md-3 mb-2">
          @include ("admin.dashboard._card2",
                        ['count' => $users_count, 'label' => 'All Users',
                        'icon' => "fas fa-users",
                        'bg_class' => 'bg-primary', 'text_class' => 'text-white'])
        </div>

        <div class="col-3 col-md-3 mb-2">
          @include ("admin.dashboard._card2",
                        ['count' => $firms_count, 'label' => 'All Firms',
                        'icon' => "fas fa-ice-cream",
                        'bg_class' => 'bg-success', 'text_class' => 'text-white'])
        </div>

        <div class="col-3 col-md-3 mb-2">
          @include ("admin.dashboard._card2",
                        ['count' => $templates_count, 'label' => 'All Templates',
                        'icon' => "fas fa-list-alt",
                        'bg_class' => 'bg-info', 'text_class' => 'text-white'])
        </div>

        <div class="col-3 col-md-3 mb-2">
          @include ("admin.dashboard._card2",
                        ['count' => $orders_count, 'label' => 'All Orders',
                        'icon' => "fas fa-hand-holding-usd",
                        'bg_class' => 'bg-info', 'text_class' => 'text-white'])
        </div>

    </div>

    <div class="row py-1">
        <div class="col-6 col-md-6 ">

          <div class="card">
            <div class="card-header bg-success text-white font-weight-bold">Last 5 Orders</div>
            <div class="card-body p-0 pt-3">

            </div>
          </div>

        </div>

        <div class="col-6 col-md-6 ">

          <div class="card">
            <div class="card-header bg-primary text-white font-weight-bold">Last 5 Users</div>
            <div class="card-body p-0 pt-2">

            </div>
          </div>

        </div>

    </div>

    <div class="row bg-info p-3 mt-5 text-white">
      Dashboard V1.0
    </div>
</div>
@endsection
