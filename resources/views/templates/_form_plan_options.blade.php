<div class="">

    <!-- Event -->
    <div v-if="planSelected == 3" class="form-group">
      <label for="event">Select Event:</label>
      <select name="event_id" value="{{ old('event_id', $template->event_id) }}" class="form-control {{ $errors->has('event_id') ? 'is-invalid' : '' }}" id="event">
          <option value="">Not Selected</option>
         @foreach($events as $event)
            <option value="{{$event->id}}">{{$event->title}}</option>
         @endforeach
      </select>
      @if ($errors->has('event_id'))
          <div class="invalid-feedback">
              <strong>{{ $errors->first('event_id') }}</strong>
          </div>
      @endif
    </div>

    <div v-if="planSelected == 4" class="form-group">
        Select Firm Types:
        @foreach($firm_types as $firm_type)
            <div class="form-check ">
              <label class="form-check-label" for="firm-type-{{$firm_type->id}}">
                <input type="checkbox" class="form-check-input" id="firm-type-{{$firm_type->id}}" name="firm_types[]" value="{{$firm_type->id}}">{{$firm_type->name}}
              </label>
            </div>
        @endforeach
    </div>

</div>
