<div class="row justify-content-center">
    <div class="col-md-12 {{$bg_class ?? 'fl_bg1'}}">
        <div class="row text-center">
                <div class="col-md-3 mt-5 mx-auto">
                    <img class="img-fluid p-2" src="{{asset( $logo ?? '' )}}" alt="">
                </div>
                <div class="col-md-12 my-4 font-weight-bold">
                    <h3>{{ $name ?? ''}}</h3>
                </div>
        </div>
    </div>
</div>
