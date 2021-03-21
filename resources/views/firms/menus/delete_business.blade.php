<div class="modal" id="deleteFirm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4>Are you sure to DELETE Business?</h4>

        <div class="text-left">
          <ul>
            <li>If business has any active plan, you can't delete business.</li>
            <li>Once deleted, all data related to business will be deleted.</li>
          </ul>
        </div>

        <div class="d-flex justify-content-center">
          <div class="mr-1">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
          <form action="{{route('firms.destroy', $firm->id)}}" class="form-delete" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger border_f" onclick="return confirm('This is second confirmation! Are you sure to delete business?')"><i class="fas fa-trash"></i> Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
