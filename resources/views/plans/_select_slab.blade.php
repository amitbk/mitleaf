<div class="form-group">
    <label for="sel1">Select Plan Type:</label>
    <select @change="changeSlab($event, localPlan)" v-model="localPlan.qty_selected" class="form-control" id="sel1">
        <option :id="localPlan.id" value="10">10 Images/Month</option>
        <option :id="localPlan.id" value="15">15 Images/Month</option>
        <option :id="localPlan.id" value="30">30 Images/Month</option>
    </select>
</div>
