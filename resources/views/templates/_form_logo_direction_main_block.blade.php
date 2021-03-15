<div class="row mb-3">
  <div class="col-12 font-weight-bold text-capitalize">{{$direction}}</div>
  <div class="col-sm-4 border">
    @include('templates._form_logo_direction_block',
                [
                  'direction_name' => $direction.'-left',
                  'prop' => $direction.'Left',
                  'style_id' => $styles[0]
                ])
  </div>
  <div class="col-sm-4 border">
    @include('templates._form_logo_direction_block',
                [
                  'direction_name' => $direction.'-center',
                  'prop' => $direction.'Center',
                  'style_id' => $styles[1]
                ])
  </div>
  <div class="col-sm-4 border">
    @include('templates._form_logo_direction_block',
                [
                  'direction_name' => $direction.'-right',
                  'prop' => $direction.'Right',
                  'style_id' => $styles[2]
                ])
  </div>
</div>
