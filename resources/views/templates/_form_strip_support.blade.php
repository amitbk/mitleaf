<!-- Strip Support -->
<div class="form-group">
  <label for="logo_support-label font-weight-bold">Strip Support:</label>

  <div class="bg-light mt-1 p-1">
      <!-- 1 -->
      <div class="form-check-inline ">
        <label class="form-check-label" for="bottom">
          <input v-model="stripSupport.bottomTouched" type="checkbox" class="form-check-input" id="bottom" name="style_supports[]" value="21">Bottom Touched
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="bottom-padding">
          <input v-model="stripSupport.bottomWithPadding" type="checkbox" class="form-check-input" id="bottom-padding" name="style_supports[]" value="22">Bottom With Padding
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
