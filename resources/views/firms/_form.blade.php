@csrf
<div class="form-group">
    <label for="firm-name">Firm Name</label>
    <input type="text" name="name" value="{{ old('name', $firm->name) }}" id="firm-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="firm-about">About your firm</label>
    <textarea name="about" id="firm-about" rows="10" class="form-control {{ $errors->has('about') ? 'is-invalid' : '' }}">{{ old('about', $firm->about) }}</textarea>

    @if ($errors->has('about'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('about') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>
