@extends('layouts.app')

@section('content')
<create-rule :tags="{{$tags}}" :rules="{{$rules}}" inline-template>
    <div class="container">

        <div v-if="!rulesAdded" class="row justify-content-center mb-3">
            @include('rules._no_rules_added')
        </div>

        <div v-else class="row justify-content-center">
            <div class="col-md-8">
                <div class="card1">
                    <div class="card-header1">
                      <div class="text-center">
                        <h2>Let's Create a Plan</h2>
                        <!-- <a href="{{ route('tags.create')}}" class="btn btn-success btn-sm">Add New</a> -->
                      </div>
                    </div>

                    <div class="card-body1  ">
                        @include('helpers._flash')


                        <div class="" v-for="tag in parentTags">
                            @include('rules._tag_item_display', ['tag' => `@{{tag}}`])
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
</create-rule>
@endsection
