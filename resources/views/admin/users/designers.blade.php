@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
            <h2>{{ $pageTitle ?? 'Users' }}
                <!-- <a href="{{ route('users.create')}}" class="btn btn-success btn-sm">Add New</a> -->
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
                <th>Templates</th>
                <th>Registered</th>
                <th>Last template</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @forelse($users as $user)
              <tr>
                <td>{{$i++}}</td>
                <td><a href="#">{{$user->name}}</a>
                </td>
                <td>{{$user->templates->count() ?? '0'}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->templates->last()->created_at ?? '-'}}</td>
                <td>

                </td>
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
