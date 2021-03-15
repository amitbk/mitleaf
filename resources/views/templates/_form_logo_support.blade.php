<!-- Logo Support -->
<div class="form-group">
  <!-- <input type="text" class="form-check-input" id="bottom-left" name="x_axis[12]"> -->

  <label for="style_supports-label font-weight-bold">Logo Support:</label>

  <div class="bg-light text-center mt-1 p-1">
      <div for="style_supports-label">Bottom</div>
      <!-- 1 -->
      <div class="form-check-inline">
          <label class="form-check-label" for="bottom-left">
              <input v-model="logoSupport.bottomLeft" type="checkbox" class="form-check-input" id="bottom-left" name="style_supports[]" value="12">Left
          </label>
      </div>

      <div class="form-check-inline ">
        <label class="form-check-label" for="bottom-center">
          <input v-model="logoSupport.bottomCenter" type="checkbox" class="form-check-input" id="bottom-center" name="style_supports[]" value="11">Center
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="bottom-right">
          <input v-model="logoSupport.bottomRight" type="checkbox" class="form-check-input" id="bottom-right" name="style_supports[]" value="13">Right
        </label>
      </div>
  </div>

  <div class="bg-light text-center mt-1 p-1">
      <div for="style_supports-label">Top</div>
      <!-- 2 -->
      <div class="form-check-inline mt-2">
          <label class="form-check-label" for="top-left">
              <input v-model="logoSupport.topLeft" type="checkbox" class="form-check-input" id="top-left" name="style_supports[]" value="15">Left
          </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="top-center">
          <input v-model="logoSupport.topCenter" type="checkbox" class="form-check-input" id="top-center" name="style_supports[]" value="14">Center
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="top-right">
          <input v-model="logoSupport.topRight" type="checkbox" class="form-check-input" id="top-right" name="style_supports[]" value="16">Right
        </label>
      </div>
  </div>

  <div class="bg-light text-center mt-1 p-1">
      <div for="style_supports-label">Center</div>
      <!-- 3 -->
      <div class="form-check-inline mt-2">
          <label class="form-check-label" for="center-left">
              <input v-model="logoSupport.centerLeft" type="checkbox" class="form-check-input" id="center-left" name="style_supports[]" value="18">Left
          </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="center-center">
          <input v-model="logoSupport.centerCenter" type="checkbox" class="form-check-input" id="center-center" name="style_supports[]" value="17">Center
        </label>
      </div>

      <div class="form-check-inline">
        <label class="form-check-label" for="center-right">
          <input v-model="logoSupport.centerRight" type="checkbox" class="form-check-input" id="center-right" name="style_supports[]" value="19">Right
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
