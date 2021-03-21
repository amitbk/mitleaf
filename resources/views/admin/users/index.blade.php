@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 d-flex">
            <h2>{{ $pageTitle ?? 'Users' }}
                <a href="{{ route('users.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
            <div class="ml-auto">
              <div class="form-group">
                <form action="{{ route('users.index') }}" method="get">
                    <input type="text" name="search" value="{{request()->search}}" class="form-control" placeholder="Search users...">
               </form>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          @include('helpers._flash')
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
                <th>Address</th>
                <th>Firms</th>
                <!-- <th>TrialUsed</th> -->
                <th>Orders</th>
                <th>Registered</th>
                <th>Last Order</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @forelse($users as $user)
              <tr>
                <td>{{$i++}}</td>
                <td> <span class="font-weight-bold">{{$user->name}}</span>
                    <br> {{$user->email}}
                    <br> <small>{{$user->mobile}}</small>
                </td>
                <td></td>

                <td>{{$user->firms->count() ?? 'No'}}</td>
                <!-- <td>{{$user->is_trial_used}}</td> -->
                <td>{{$user->orders->count() ?? 'No'}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->orders->last()->created_at ?? 'No'}}</td>
                <td>
                  @if(auth()->user()->role_id == 1 && $user->account_type_id == 1 && $user->role_id != 1)
                    <a href="{{url('fly/users/'.$user->id.'/revoke')}}"> <?php echo $user->is_revoked ? '<strong>UnRevoke</strong>' : 'Revoke';?></a>
                  @endif
                </td>
              </tr>
              @empty
                No users yet.
              @endforelse
            </tbody>
          </table>
        </div>

        {{$users->appends(request()->except('page'))->links()}}
      </div>

    </div>
</div>
@endsection
