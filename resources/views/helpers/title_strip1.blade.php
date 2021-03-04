<div class="row justify-content-center">
    <div class="col-md-12 {{$bg_class ?? 'fl_bg1'}}">
        <div class="row text-center">
                <div class="col-md-3 mt-5 mx-auto">
                    <img class="img-fluid p-2" src="{{asset( $logo ?? '' )}}" alt="">
                </div>
                <div class="col-md-12 my-4">
                    <h3 class="font-weight-bold">{{ $name ?? ''}}</h3>
                    {{$title2}}

                    @if($link_url ?? 0)
                      <div class="">
                          <a href="{{$link_url}}" class="btn btn-outline-primary btn-sm">{{$link_title}}</a>
                        </div>
                    @endif
                </div>
        </div>
    </div>
</div>
