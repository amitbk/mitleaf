<label class="form-check-label" for="{{$direction_name}}">
    <input v-model="logoSupport.{{$prop}}" type="checkbox" class="form-check-input" id="{{$direction_name}}" name="style_supports[]" value="{{$style_id}}">{{$direction_name}}
</label>

<div class="d-flex f-12">

  <div class="form-group">
    <label for="inputsm">Ratio%</label>
    <input name="ratio[{{$style_id}}]" class="form-control input-sm" type="text" value='30'>
  </div>

  <div class="form-group">
    <label for="inputsm">X Axis</label>
    <input name="x_axis[{{$style_id}}]" class="form-control input-sm" type="text" value='10'>
  </div>

  <div class="form-group">
    <label for="inputsm">Y Axis</label>
    <input name="y_axis[{{$style_id}}]" class="form-control input-sm" type="text" value='10'>
  </div>
</div>
