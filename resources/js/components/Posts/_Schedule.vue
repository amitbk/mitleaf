<template>
  <div class="row justify-content-center">
    <div class="col-sm-3">
      <img src="https://picsum.photos/200/200" alt="" class="img-fluid img-thumbnail">
    </div>

    <div class="col-sm-5">
      <div class="form-group" style="width: auto">
        <label for="usr">Select Date:</label>
        <input v-model="$root.post.schedule_on" type="date" class="form-control" id="usr">
      </div>

      <select v-model="$root.post.plan_id" class="form-control form-control-sm" style="width: auto" >
        <option value="0">Select Plan to use</option>
        <option :value="plan.id" v-for="plan in $root.mitleaf.plans">{{plan.name}}</option>
      </select>

      <div class="text-center">

        <button class="btn btn-success" @click="onSaveClick"> Save</button>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        Click on save button to schedule post.
      </div>
    </div>
  </div>
</template>

<script>

export default {
  mounted() {
  },
  methods: {
    onSaveClick() {
      this.$emit('save');
    },
    processDone() {
      this.$emit('process-done', 3);
    }
  }
}
</script>

<style>

</style>
