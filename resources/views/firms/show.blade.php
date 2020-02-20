@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 fl_bg1">
            <div class="row text-center">
                    <div class="col-md-3 mt-5 mx-auto">
                        <img class="img-fluid p-2" src="{{asset( $firm->logo() )}}" alt="">
                    </div>
                    <div class="col-md-12 my-4 font-weight-bold">
                        <h3>{{$firm->name}}</h3>
                    </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-9 col-xs-12 mt-3">
            @include('helpers._flash')

            <div class="row">
                <div class="col-md-8 mb-5">


                    <div class="card my-2">

                        <!-- top -->
                        <div class="media p-2 border_b">
                          <img src="https://picsum.photos/50" alt="John Doe" class="mr-2 rounded-circle">
                          <div class="media-body">
                            <div class="font-weight-bold">John Doe <small class="text-secondary">Posted on February 19, 2016</small></div>
                            <div class="text-secondary">
                                <span class="fl_tag">Hello</span>
                            </div>
                          </div>
                        </div>

                        <div class="card_content p-2">
                            hello
                        </div>
                        <div class="card_media border_b">
                            <img class="img-fluid w-100" src="https://picsum.photos/500/300" alt="">
                        </div>
                        <div class="card_options p-2">
                            <button class="btn btn-default btn-sm border_f" type="button" name="button"><i class="fas fa-sync"></i> Recreate</button>

                            <button class="btn btn-default btn-sm border_f float-right" type="button" name="button"><i class="fas fa-cloud-download-alt"></i> Download</button>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        Hello
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
