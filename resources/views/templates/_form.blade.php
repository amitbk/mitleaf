<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              <div class="">
                Create Template
                <a href="{{ route('templates.index')}}" class="btn btn-info btn-sm">Back</a>
                <button type="submit" class="btn btn-success btn-sm">{{ $buttonText }}</button>

              </div>
            </div>

            <div class="card-body">

                <!-- Template name -->
                <div class="form-group">
                    <label for="template-name">Template Name:</label>
                    <input type="text" name="name" value="{{ old('name', $template->name) }}" id="template-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>

                <!-- Desc -->
                <div class="form-group">
                    <label for="template-desc">Desc:</label>
                    <input type="text" name="desc" value="{{ old('desc', $template->desc) }}" id="template-desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}">

                    @if ($errors->has('desc'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('desc') }}</strong>
                        </div>
                    @endif
                </div>

                <hr>

                <!-- Plan Name -->
                <div class="form-group">
                  <label for="plan">Select Plan:</label>
                  <select name="plan_id" value="{{ old('plan_id', $template->plan_id) }}" class="form-control {{ $errors->has('plan_id') ? 'is-invalid' : '' }}" id="plan">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                  </select>
                  @if ($errors->has('plan_id'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('plan_id') }}</strong>
                      </div>
                  @endif
                </div>

                <hr>
                <!-- Language -->
                <div class="form-group">
                  <label for="language">Language:</label>
                  <select name="language" value="{{ old('language', $template->language) }}" class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}" id="language">
                    <option value="0">No Language</option>
                    <option value="m" selected>Marathi</option>
                    <option value="h">Hindi</option>
                    <option value="e">English</option>
                  </select>
                  @if ($errors->has('language'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('language') }}</strong>
                      </div>
                  @endif
                </div>

                <!-- Shape -->
                <div class="form-group">
                  <label for="shape">Shape:</label>
                  <select name="shape" value="{{ old('shape', $template->shape) }}" class="form-control {{ $errors->has('shape') ? 'is-invalid' : '' }}" id="shape">
                    <option value="1" selected>Square</option>
                    <option value="2">Portrait</option>
                    <option value="3">Landscape</option>
                  </select>
                  @if ($errors->has('shape'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('shape') }}</strong>
                      </div>
                  @endif
                </div>

                <!-- Style -->
                <div class="form-group">
                  <label for="style">Style:</label>
                  <select name="style" value="{{ old('style', $template->style) }}" class="form-control {{ $errors->has('style') ? 'is-invalid' : '' }}" id="style">
                    <option value="6">Both</option>
                    <option value="7" selected>Light</option>
                    <option value="8">Dark</option>
                  </select>
                  @if ($errors->has('style'))
                      <div class="invalid-feedback">
                          <strong>{{ $errors->first('style') }}</strong>
                      </div>
                  @endif
                </div>
                <hr>

                @include('templates._form_logo_support')
                @include('templates._form_strip_support')



            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <div class="">
                Template Image
                <a href="{{ route('templates.index')}}" class="btn btn-info btn-sm">Back</a>
              </div>
            </div>

            <div class="card-body">

                <input ref="image" type="file" id="file" name="image" id="image" @change="displaySelectedImage()">
				<br>
				@if ($errors->has('image'))
				<span class="help-block">
					<strong>{{ $errors->first('image') }}</strong>
				</span>
				@endif
				<br>
                <div class="text-center" id="image_preview"  >
                    <img id="image_preview" class="img-responsive" style="max-height: 800px; max-width: 500px; margin: 0 auto 0;" :src="templateImage" alt="Ad image">
                </div>

            </div>
        </div>
    </div>

</div>
