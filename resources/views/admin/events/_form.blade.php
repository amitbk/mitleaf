<div class="form-group">
    <label for="event-title">Event Title</label>
    <input type="text" name="title" value="{{ old('title', $event->title) }}" id="event-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Event Title">

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="event-desc">Desc</label>
    <input type="text" name="desc" value="{{ old('desc', $event->desc) }}" id="event-desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" placeholder="Event desc">

    @if ($errors->has('desc'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('desc') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="event-desc">Date</label>
    <input type="date" name="date" value="{{ old('date', date('d-M-Y', strtotime($event->date) ) ) }}" id="event-date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" placeholder="Event date">

    @if ($errors->has('date'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('date') }}</strong>
        </div>
    @endif
</div>

<div class="form-group text-center">
    <button type="submit" class="btn btn-primary btn-lg">{{ $buttonText }}</button>
</div>
