@extends('layouts.app')

@section('content')
<select-tag inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <div class="">
                        Let's Create a Plan @{{amit}}
                        <!-- <a href="{{ route('tags.create')}}" class="btn btn-success btn-sm">Add New</a> -->
                      </div>
                    </div>

                    <div class="card-body">
                        <div v-if="!!amit" class="">
                            amit
                        </div>
                        <div v-else>
                            Kadam
                        </div>
                        @include('helpers._flash')
                        @foreach($tags as $tag)
                          <h2>{{$tag->name}}</h2>
                          @foreach($tag->tags as $child_tag)
                            <h4>- {{$child_tag->name}}</h4>
                          @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</select-tag>
@endsection
