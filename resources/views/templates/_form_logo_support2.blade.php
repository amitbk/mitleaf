<div class="card  mb-2">
    <div class="card-header">
      <div class="">
        Logo Support
      </div>
    </div>

    <div class="card-body text-center">

      @include('templates._form_logo_direction_main_block',
              [
                'direction' => 'bottom',
                'styles' => [12,11,13]
              ])
      @include('templates._form_logo_direction_main_block', ['direction' => 'top', 'styles' => [15,14,16] ])


      @if ($errors->has('style_supports'))
          <div class="invalid-feedback">
              <strong>{{ $errors->first('style_supports') }}</strong>
          </div>
      @endif

    </div>
</div>
