@extends('layouts.admin')

@section('content')
<div class="container py-2">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>{{ $pageTitle ?? 'Events' }}
                <a href="{{ route('events.create')}}" class="btn btn-success btn-sm">Add New</a>
            </h2>
            @include('helpers._flash')
        </div>
    </div>
    <div class="row justify-content-center">
      @foreach($events as $event)
      <div class="col-md-6 justify-content-center mb-4">

          <div class="card h-100">
              <div class="card-body d-flex ">
                  <div class="">
                    <h4><a href="{{route('events.show', $event->id)}}" class="text-decoration-none">{{$event->title}}</a></h4>
                    <span class="text-secondary">{{date('d M, Y', strtotime($event->date) )}}</span>
                    <span>🎨 {{$event->templates->count()}} Templates</span>
                    <div class="">
                      {{$event->desc}}
                    </div>

                  </div>
                  <span class="ml-auto ">
                    <a href="{{route('events.edit',$event->id)}}" class="d-none btn btn-outline-primary btn-sm">Edit</a>

                    <form class="form-delete col p-1" style="display: unset" method="post" action="{{ route('events.destroy', $event->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm border_f" onclick="return confirm('Are you sure?')"><i class="fas fa-cloud-download-alt"></i> Delete</button>
                    </form>

                  </span>
              </div>
          </div>

      </div>
      @endforeach
    </div>
</div>
@endsection
