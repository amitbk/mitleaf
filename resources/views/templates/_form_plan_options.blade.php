<div class="">

    <!-- Event -->
    <div v-if="planSelected == 3" class="form-group">
      <label for="event">Select Event:</label>
      <select name="event_id" value="{{ old('event_id', $template->event_id) }}" class="form-control {{ $errors->has('event_id') ? 'is-invalid' : '' }}" id="event">
          <option value="">Not Selected</option>
         @foreach($events as $event)
            <option value="{{$event->id}}">{{$event->name}}</option>
         @endforeach
      </select>
      @if ($errors->has('event_id'))
          <div class="invalid-feedback">
              <strong>{{ $errors->first('event_id') }}</strong>
          </div>
      @endif
    </div>


</div>
