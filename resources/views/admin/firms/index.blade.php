@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 text-center">
            @include('helpers._flash')
            <h2>{{ $pageTitle ?? 'Firms' }}
                <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
        </div>
    </div>
    <div class="row justify-content-center">

      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Created</th>
                <th>Orders</th>
                <th>Last Order</th>
                <th>Option</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @forelse($firms as $firm)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$firm->name}}</td>
                <td>{{$firm->users()->first()->name ?? '-'}}</td>
                <td>{{$firm->created_at}}</td>
                <td>{{$firm->orders->count() ?? 'No'}}</td>
                <td>{{$firm->orders->last()->created_at ?? 'No'}}</td>
                <td>
                  <a href="{{route('firms.edit',$firm->id)}}" class="btn btn-primary btn-sm">Edit</a>
                </td>
              </tr>
              @empty
                No firms yet.
              @endforelse
            </tbody>
          </table>
        </div>

        {{$firms->links()}}
      </div>

    </div>
</div>
@endsection
