@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
            <h2>{{ $pageTitle ?? 'Users' }}
                <a href="{{ route('users.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
        </div>
    </div>
    <div class="row ">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Firms</th>
                <th>TrialUsed</th>
                <th>Orders</th>
                <th>Registered</th>
                <th>Last Order</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @forelse($users as $user)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->firms->count() ?? 'No'}}</td>
                <td>{{$user->is_trial_used}}</td>
                <td>{{$user->orders->count() ?? 'No'}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->orders->last()->created_at ?? 'No'}}</td>
              </tr>
              @empty
                No users yet.
              @endforelse
            </tbody>
          </table>
        </div>

        {{$users->links()}}
      </div>

    </div>
</div>
@endsection
