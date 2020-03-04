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
    <label for="firm_type_id">Select Business Type:</label>
    <select name="firm_type_id" v-model="firm_type_id" class="form-control" id="firm_type_id">
        <option v-for="firm_type in firm_types" :value="firm_type.id">@{{firm_type.name}}</option>
    </select>
</div>

<div class="form-group" v-if="firm_type_id == 4">
    <label for="business_type">What is your business type?</label>
    <input name="business_type" type="text" name="business_type" value="{{ old('business_type', $firm->business_type) }}" id="business_type" class="form-control {{ $errors->has('business_type') ? 'is-invalid' : '' }}">

    @if ($errors->has('business_type'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('business_type') }}</strong>
        </div>
    @endif
</div>

<div class="form-group text-center">
    <button type="submit" class="btn btn-primary btn-lg">{{ $buttonText }}</button>
</div>
