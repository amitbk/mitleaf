<firm-frame :frame="{{ $frame }}" inline-template>
    <div class="card my-2">
        <!-- top -->
        <div class="media p-2 border_b">
        <img src="https://picsum.photos/50" alt="John Doe" class="mr-2 rounded-circle">
        <div class="media-body">
            <div class="font-weight-bold">
                @{{frame.firm_plan.firm.name}}
                <small class="text-secondary" title="Frame was scheduled for this day."><i class="far fa-clock"></i> @{{frame.schedule_on | formatDate}}</small>
            </div>
            <div class="text-secondary">
                <span class="fl_tag bg_sky1">@{{frame.firm_plan.plan.name}}</span>
                <span v-if="frame.firm_plan.firm_type_id" class="fl_tag">@{{frame.firm_plan.firm_type.name}}</span>
            </div>
        </div>
        </div>

        <div class="card_content p-2">
            hello
        </div>
        <div class="card_media border_b">
            <image-preview :image="frameImage" no-image-msg="No frame created yet."/>
        </div>
        <div class="card_options p-2">
            <button @click="onRecreateFrameClick" class="btn btn-default btn-sm border_f" type="button" name="button">
                <i class="fas fa-sync"></i> Recreate</button>

            <button class="btn btn-default btn-sm border_f float-right" type="button" name="button"><i class="fas fa-cloud-download-alt"></i> Download</button>
        </div>
    </div>
</firm-frame>
