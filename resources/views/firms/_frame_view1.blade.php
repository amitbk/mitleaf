<firm-post :post-prop="{{ $post }}" inline-template>
    <div class="card mb-2 shadow">
        <!-- top -->
        <div class="row">
          <div class="col-9">


            <div class="media p-2">
              <img src="{{asset($firm->logo())}}" alt="John Doe" class="mr-2 fl_avatar">
              <div class="media-body">
                  <div class="font-weight-bold">
                      @{{post.firm_plan.firm.name}}
                      <small class="text-secondary" title="Post was scheduled for this day."><i class="far fa-clock"></i> @{{post.schedule_on | formatDate}}</small>
                  </div>
                  <div class="text-secondary">
                      <!-- plan name: Business | Indian Event | Quotes -->
                      <span class="fl_tag bg_sky1">@{{post.firm_plan.plan.name}}</span>
                      <!-- Sub type: Hospital | Event Name -->
                      <span v-if="post.firm_plan.firm_type_id" class="fl_tag">@{{post.firm_plan.firm_type.name}}</span>
                      <span v-if="!!post.event" class="fl_tag">@{{post.event.name}}</span>
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

        <div class="card_content border-top" :class="{p2:post.image}">
            @{{post.content}}
        </div>
        <div class="card_media border_b">
            <image-preview :image="post.image" no-image-msg="No post created yet."/>
        </div>
        <div class="card_options p-2">
            <button @click="onRecreatePostClick" class="btn btn-default btn-sm border_f" type="button" name="button">
                <i class="fas fa-sync"></i> Recreate</button>

            <button class="btn btn-default btn-sm border_f float-right" type="button" name="button"><i class="fas fa-cloud-download-alt"></i> Download</button>
        </div>
    </div>
</firm-post>
