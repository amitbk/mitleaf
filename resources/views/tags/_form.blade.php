@csrf
<div class="form-group">
    <label for="firm-name">What is name of your business?</label>
    <input type="text" name="name" value="{{ old('name', $firm->name) }}" id="firm-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="firm-name">Business TagLine:</label>
    <input type="text" name="tagline" value="{{ old('tagline', $firm->tagline) }}" id="firm-tagline" class="form-control {{ $errors->has('tagline') ? 'is-invalid' : '' }}">

    @if ($errors->has('tagline'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('tagline') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="firm-name">Address?</label>
    <input type="text" name="address" value="{{ old('address', $firm->address) }}" id="firm-address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">

    @if ($errors->has('address'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('address') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>
