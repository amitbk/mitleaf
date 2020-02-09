<!-- Strip Support -->
<div class="form-group">
  <label for="logo_support-label font-weight-bold">Strip Support:</label>

  <div class="bg-light mt-1 p-1">
      <!-- 1 -->
      <div class="form-check-inline ">
        <label class="form-check-label" for="bottom">
          <input v-model="stripSupport.bottomTouched" type="checkbox" class="form-check-input" id="bottom" name="strip_support[]" value="21">Bottom Touched
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="bottom-padding">
          <input v-model="stripSupport.bottomWithPadding" type="checkbox" class="form-check-input" id="bottom-padding" name="strip_support[]" value="22">Bottom With Padding
        </label>
      </div>
  </div>


  @if ($errors->has('strip_support'))
      <div class="invalid-feedback">
          <strong>{{ $errors->first('strip_support') }}</strong>
      </div>
  @endif
</div>
<hr>
