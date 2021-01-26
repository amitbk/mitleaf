<template>
  <div class="new_post__wrapper">
    <!-- The Modal -->
    <b-modal id="modalNewPost" title="BootstrapVue" hide-footer size="lg" @shown="getTemplates">
      <template #modal-header="{ close }">
        <!-- Emulate built in modal header close button action -->
        <span class="f-20">Create a new post for
          <select v-model="$root.selectedFirmId" class="form-control form-control-sm" style="width: auto" >
            <option value="0">Select Business</option>
            <option :value="firm.id" v-for="firm in $root.mitleaf.firms">{{firm.name}}</option>
          </select>
        </span>

        <b-button size="sm" variant="outline-danger" @click="close()">
          Close
        </b-button>
      </template>

      <template>
        <SelectTemplate @get-templates="getTemplates"/>
      </template>

    </b-modal>

  </div>
</template>

<script>
import SelectTemplate from "./_SelectTemplate";
import FrameManager from "./_FrameManager";
import templateServices from "../../services/templates"

export default {
  components: {
    SelectTemplate,
    FrameManager
  },

  methods: {
    getTemplates: function (data = {filters: {}} ) {
      if(!!data.filters == false) data.filters = {};
      data.filters.firm_id = this.$root.selectedFirmId;
      templateServices.getTemplates(data).then(r => {
        this.$root.templates = r.data;
      })
    },
  }
}
</script>

<style>

</style>
