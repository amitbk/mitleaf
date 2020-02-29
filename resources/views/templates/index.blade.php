@extends('layouts.app8')

@section('content')

<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => 'Templates', 'logo' => '' ] )

    <div class="row">
        <div class="col-md-12">
            @include('helpers._flash')
        </div>
    </div>

    <div class="row justify-content-center py-4">
        <div class="col-md-2 my-2" >
            <a href="{{route('templates.create')}}" class="btn btn-primary btn-block">Add New</a>
            <a href="#" class="btn btn-light btn-block border_f">Filter</a>
        </div>
        <div class="col-md-4">
            <div class="row">


                @foreach($templates as $template)
                <div class="card my-2">
                    <!-- top -->
                    <div class="media p-2 border_b">
                      <img src="https://picsum.photos/50" alt="John Doe" class="mr-2 rounded-circle">
                      <div class="media-body">
                        <div class="font-weight-bold">{{$template->user->name ?? 'Unknown'}} <small class="text-secondary">Created on {{$template->created_at->format('d M,Y h:i:s a')}}</small></div>
                        <div class="text-secondary">
                            <span class="fl_tag bg_sky1">{{$template->plan->name}}</span>
                            @if($template->event)
                                <span class="fl_tag">{{$template->event->name}}</span>
                            @endif
                            @foreach($template->firm_types as $firm_type)
                                <span class="fl_tag">{{$firm_type->name}}</span>
                            @endforeach
                        </div>
                      </div>
                    </div>

                    <div class="card_content p-2">
                        {{$template->name}}
                        {{$template->desc}}
                    </div>
                    <div class="card_media border_b">
                        <img class="img-fluid w-100" src="{{$template->image->url}}" alt="">
                    </div>
                    <div class="card_options p-2">
                        <a href="{{ route('templates.edit', $template->id) }}" class="btn btn-default btn-sm border_f"><i class="fas fa-cloud-download-alt"></i> Edit</a>
                        <form class="form-delete col p-1" style="display: unset" method="post" action="{{ route('templates.destroy', $template->id) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-default btn-sm border_f" onclick="return confirm('Are you sure?')"><i class="fas fa-cloud-download-alt"></i> Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            {{$templates->links()}}
        </div>
    </div>
</div>
@endsection
