@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('helpers.title_strip1', ['name' => $firm->name, 'logo' => $firm->logo() ] )

    <div class="row justify-content-center">
        <div class="col-md-9 col-xs-12 mt-3 justify-content-center">
            @include('helpers._flash')

            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    @if($firm->plans->count() == 0 )
                        <!-- if no plan, ask to purchase plan -->
                        <div class="card text-center mb-3">
                          <div class="card-body">No any plans active, please buy any plan.
                              <br>
                            <a href="{{route('plans.index')}}" class="btn btn-primary">View Plans</a>
                          </div>

                        </div>
                    @endif

                    @forelse ($posts as $post)
                        @include('firms._post_view2')
                    @empty
                        <h4>No posts yet</h4>
                    @endforelse

                    {{$posts->links()}}
                </div>

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            @if($firm->logo())
                                <img class="img-fluid p-2" src="{{asset( $firm->logo() ?? '' )}}" alt="">
                            @else
                                <div class="">
                                    No logo added.
                                </div>
                            @endif
                            <a href="{{route('firms.edit_assets', [$firm->id, 1] )}}" class="btn btn-primary"> {{$firm->logo() ? 'Change' : 'Add'}} Logo</a>
                        </div>
                        <div class="card-footer">Logo</div>
                    </div>

                    <div class="card my-2 text-center">
                        <div class="card-body">
                            @if($firm->strip())
                                <img class="img-fluid p-2" src="{{asset( $firm->strip() ?? '' )}}" alt="">
                            @else
                                <div class="">
                                    No strip added.
                                </div>
                            @endif
                            <a href="{{route('firms.edit_assets', [$firm->id, 3])}}" class="btn btn-primary"> {{$firm->strip() ? 'Change' : 'Add'}} Strip</a>
                        </div>
                        <div class="card-footer">Strip</div>
                    </div>

                    <div class="card my-2 text-center">
                        <div class="card-body">
                            Update firm details
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
