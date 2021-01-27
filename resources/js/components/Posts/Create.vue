<template>
  <div class="new_post__wrapper">
    <!-- The Modal -->
    <b-modal id="modalNewPost" hide-footer title="Create a new post" size="lg" @shown="getTemplates">
      <template :class="'p-2 px-3'" #modal-header="{ close }">
        <h4>Create a new post</h4>
        <b-button size="sm" variant="outline-danger" @click="close()">
          Close
        </b-button>
      </template>

      <template :class="'p-2'">
        <SelectTemplate v-if="step == 1 " @get-templates="getTemplates" @process-done="onProcessDone" @template-selected="onProcessDone"/>
        <FrameManager  v-else-if="step == 2 " @save="savePost" @process-done="onProcessDone"/>
        <Schedule  v-else-if="step == 3" @save="savePost"  @process-done="onProcessDone"/>
      </template>


    </b-modal>

  </div>
</template>

<script>
import SelectTemplate from "./_SelectTemplate";
import FrameManager from "./_FrameManager";
import Schedule from "./_Schedule";

import templateServices from "../../services/templates";
import alert from "../../services/alert";
import postObj from "../../obj/post";

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
          this.$root.post = { ...postObj };
          this.$bvModal.hide('modalNewPost');

          alert.success('Post has been saved successfully.');
          this.step = 1;

          this.$emit('post-added');
      })

      this.step = 2;
    }
  }
}
</script>

<style>

</style>
