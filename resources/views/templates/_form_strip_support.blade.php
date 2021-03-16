<!-- Strip Support -->
<div class="form-group">
  <label for="logo_support-label font-weight-bold">Strip Support:</label>

  <div class="bg-light mt-1 p-1">
      <!-- 1 -->
      <div class="form-check-inline ">
        <label class="form-check-label" for="bottom">
          <input type="checkbox" class="form-check-input" id="bottom" name="style_supports[]" value="21" {{ in_array(21, $template->styles->pluck('style_id')->toArray() ) ? 'checked' : '' }} >Bottom Touched
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="bottom-padding">
          <input type="checkbox" class="form-check-input" id="bottom-padding" name="style_supports[]" value="22" {{ in_array(22, $template->styles->pluck('style_id')->toArray() ) ? 'checked' : '' }}>Bottom With Padding
        </label>
      </div>
  </div>


  @if ($errors->has('style_supports'))
      <div class="invalid-feedback">
          <strong>{{ $errors->first('style_supports') }}</strong>
      </div>
  @endif
</div>
<hr>
