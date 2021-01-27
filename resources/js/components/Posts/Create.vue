<template>
  <div class="new_post__wrapper">
    <!-- The Modal -->
    <b-modal id="modalNewPost" title="BootstrapVue" hide-footer size="lg" @shown="getTemplates">
      <template #modal-header="{ close }">
        <!-- Emulate built in modal header close button action -->
        <span class="f-20">Create a new post for
          <select v-model="$root.post.firm_id" class="form-control form-control-sm" style="width: auto" >
            <option value="0">Select Business</option>
            <option :value="firm.id" v-for="firm in $root.mitleaf.firms">{{firm.name}}</option>
          </select>
        </span>

        <b-button size="sm" variant="outline-danger" @click="close()">
          Close
        </b-button>
      </template>

      <template>
        <SelectTemplate v-if="step == 1 " @get-templates="getTemplates" @process-done="onProcessDone" @template-selected="onProcessDone"/>
        <FrameManager  v-else-if="step == 2 " @process-done="onProcessDone"/>
        <Schedule  v-else-if="step == 3" @save="savePost"  @process-done="onProcessDone"/>
      </template>

    </b-modal>

  </div>
</template>

<script>
import SelectTemplate from "./_SelectTemplate";
import FrameManager from "./_FrameManager";
import Schedule from "./_Schedule";

import templateServices from "../../services/templates"

export default {
  data () {
    return {
      step: 1
    }
  },
  components: {
    SelectTemplate, FrameManager, Schedule
  },

  methods: {
    getTemplates: function (data = {filters: {}} ) {
      if(!!data.filters == false) data.filters = {};
      data.filters.firm_id = this.$root.selectedFirmId;
      templateServices.getTemplates(data).then(r => {
        this.$root.templates = r.data;
      })
    },

    onProcessDone(data) {
      this.step = data+1;
    },

    savePost() {
      let url = !!this.$root.post.template_id ? 'create_frame_by_template' : 'create_frame_by_userimage';
      axios.post('/api/'+url, this.$root.post).then(res => {
        // frame generated
          this.post = res.data;
      })

      this.step = 2;
    }
  }
}
</script>

<style>

</style>
