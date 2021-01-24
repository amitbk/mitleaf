<firm-frame :frame-prop="{{ $frame }}" inline-template>

  <div class="card shadow-sm mb-3">
    <div class="card-body p-0">

      <div class="row">
        <div class="col-6 col-sm-3 col-md-3 col-lg-2 pr-0 h-100">

          <div class="card__date_wrapper p-3 bg-lightcyan h-100">
            <div class="card__date f-50 ">
              {{date('d', strtotime($frame->schedule_on))}}
            </div>
            <div class="card__date">
              {{date('M', strtotime($frame->schedule_on))}}
            </div>
          </div>

        </div>
        <div class="col-6 col-sm-3 col-md-3 col-lg-2 py-2">
          <image-preview :frame-view="2" class="card__image img-fluid h-100 w-100 pr-3 pr-sm-0" :image="frame.image" no-image-msg="No frame created yet."/>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-8 p-2">
          <div class="card__business_meta px-3 px-sm-0">
            <div class="font-weight-bold">@{{frame.firm_plan.firm.name}}</div>
            <div class="text-secondary">
                <!-- plan name: Business | Indian Event | Quotes -->
                <span class="fl_tag bg_sky1">@{{frame.firm_plan.plan.name}}</span>
                <!-- Sub type: Hospital | Event Name -->
                <span v-if="frame.firm_plan.firm_type_id" class="fl_tag">@{{frame.firm_plan.firm_type.name}}</span>
                <span v-if="!!frame.event" class="fl_tag">@{{frame.event.name}}</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

    <div v-if="false" class="card mb-2 shadow">
        <!-- top -->
        <div class="row">
          <div class="col-9">


            <div class="media p-2">
              <img src="{{asset($firm->logo())}}" alt="John Doe" class="mr-2 fl_avatar">
              <div class="media-body">
                  <div class="font-weight-bold">
                      @{{frame.firm_plan.firm.name}}
                      <small class="text-secondary" title="Frame was scheduled for this day."><i class="far fa-clock"></i> @{{frame.schedule_on | formatDate}}</small>
                  </div>
                  <div class="text-secondary">
                      <!-- plan name: Business | Indian Event | Quotes -->
                      <span class="fl_tag bg_sky1">@{{frame.firm_plan.plan.name}}</span>
                      <!-- Sub type: Hospital | Event Name -->
                      <span v-if="frame.firm_plan.firm_type_id" class="fl_tag">@{{frame.firm_plan.firm_type.name}}</span>
                      <span v-if="!!frame.event" class="fl_tag">@{{frame.event.name}}</span>
                  </div>
              </div>
            </div>

          </div>
          <div class="col-3">

            <div class="card__date_wrapper p-2 bg-lightcyan h-100 ">
              <div class="card__date f-20 ">
                10
              </div>
              <div class="card__date">
                Jan
              </div>
            </div>

          </div>
        </div>

        <div class="card_content border-top" :class="{p2:frame.image}">
            @{{frame.content}}
        </div>
        <div class="card_media border_b">
            <image-preview :image="frame.image" no-image-msg="No frame created yet."/>
        </div>
        <div class="card_options p-2">
            <button @click="onRecreateFrameClick" class="btn btn-default btn-sm border_f" type="button" name="button">
                <i class="fas fa-sync"></i> Recreate</button>

            <button class="btn btn-default btn-sm border_f float-right" type="button" name="button"><i class="fas fa-cloud-download-alt"></i> Download</button>
        </div>
    </div>

</firm-frame>
