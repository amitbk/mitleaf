@extends('layouts.app8')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('helpers._flash')
            <h3>All Templates</h3>
            <div class="row equal">
                @foreach($templates as $template)
                <div class="col-sm-4 d-flex pb-3">
                     <div class="card">
                        <img class="card-img-top" src="{{$template->image->url}}" alt="Card image" style="width:100%; height: 200px;">
                        <div class="card-body">
                          <h4 class="card-title">{{$template->name}}</h4>
                          <p class="card-text">{{$template->desc}}</p>

                              <div class="row no-gutters" style="grid-gap: 5px;">
                                <a href="{{ route('templates.edit', $template->id) }}" class="btn btn-primary btn-sm stretched-link col m-1">Edit</a>
                                <form class="form-delete col m-1" method="post" action="{{ route('templates.destroy', $template->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger col" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                             </div>
                        </div>
                      </div>
                </div>
                @endforeach
            </div>

            {{$templates->links()}}
        </div>
    </div>
</div>
@endsection
