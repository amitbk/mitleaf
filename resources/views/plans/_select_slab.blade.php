<div class="form-group">
    <label for="sel1">Select Plan Type:</label>
    <select v-model="localPlan.slab_selected" class="form-control" id="sel1">
        <option :id="localPlan.id" value="2">15 Images/Month</option>
        <option :id="localPlan.id" value="1">30 Images/Month</option>
    </select>
</div>
