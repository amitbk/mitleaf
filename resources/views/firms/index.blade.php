@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 text-center d-flex border-bottom mb-3">
            <h3><i class="fas fa-briefcase"></i> {{ $pageTitle ?? 'Firms' }}           </h3>
            <div class="ml-auto">
              <a href="{{ route('firms.create')}}" class="btn btn-success btn-sm">Add New Business</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-8">
        @include('helpers._flash')
      </div>
    </div>

    <div class="row justify-content-center">
        @forelse($firms as $firm)
        <div class="col-md-4 justify-content-center mb-4">

            <div class="card shadow">
                <div class="card-body">

                    <h4><a href="{{route('firms.show', $firm->id)}}" class="text-decoration-none font-weight-bold"><i class="fas fa-business-time"></i> {{$firm->name}}</a></h4>
                    <div class="">
                      {{$firm->firm_type->name ?? ''}}
                    </div>
                    <small class="font-weight-bold text-success">Plan expiring on: {{$firm->date_expiry()}}</small>
                </div>
                <div class="card-footer d-flex">
                  <a href="{{route('firms.show',$firm->id)}}" class="btn btn-outline-primary btn-sm mr-2">View</a>
                  <a href="{{route('firms.edit',$firm->id)}}" class="btn btn-outline-primary btn-sm ml-auto">Edit Information</a>
                  <!-- <form action="{{route('firms.destroy', $firm->id)}}" class="form-delete ml-auto" method="post">
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm border_f" onclick="return confirm('Are you sure? All details related to firm will be deleted.')"><i class="fas fa-trash"></i> Delete</button>
                  </form> -->
                </div>
            </div>

        </div>
        @empty
          <h3>No businesses added.</h3>
        @endforelse
    </div>
</div>
@endsection
