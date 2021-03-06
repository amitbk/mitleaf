@extends('layouts.app')

@section('content')
<select-tag :tags="{{$tags}}" inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <div class="">
                        Let's Create a Plan
                        <!-- <a href="{{ route('tags.create')}}" class="btn btn-success btn-sm">Add New</a> -->
                      </div>
                    </div>

                    <div class="card-body">
                        @include('helpers._flash')

                        <div class="" v-for="tag in parentTags">
                            @{{tag.name}}
                            <div class="cursor_pointer" v-for="childTag in childTags(tag.id)" @click="onTagClick(childTag)">
                                - @{{childTag.name}} @{{childTag.rate}}/img
                            </div>
                        </div>

                        <hr>
                        Selected Tags:
                        <div class="cursor_pointer" v-for="tag in selectedTags">
                            - @{{tag.name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</select-tag>
@endsection
