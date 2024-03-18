<form action="{{ route('pickuppoint.update') }}" method="Post" id="add_form">
  @csrf
  <div class="modal-body">

        <div class="form-group">
          <label for="coupon_code">Pickup Point Name <span class="text-danger">*</span> </label>
          <input type="text" class="form-control"  name="pickup_point_name" required="">
        </div>     
        <div class="form-group">
          <label for="coupon_amount">Address <span class="text-danger">*</span></label>
          <input type="text" class="form-control"  name="pickup_point_address" required="">
        </div>
        <div class="form-group">
          <label for="coupon_amount">Phone <span class="text-danger">*</span></label>
          <input type="text" class="form-control"  name="pickup_point_phone" required="">
        </div>
        <div class="form-group">
          <label for="coupon_amount">Another Phone </label>
          <input type="text" class="form-control"  name="pickup_point_phone_two" >
        </div> 
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="Submit" class="btn btn-primary">Submit</button>
  </div>
</form>

<script>
  $('#edit_form').submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var request =$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){  
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('#editModal').modal('hide');
          table.ajax.reload();
        }
      });
    });
</script>