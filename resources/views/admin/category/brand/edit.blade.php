{{-- <!-- Dropify -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">    --}}

<form action="{{ route('brand.update') }}" method="Post" id="add-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">

            <div class="form-group">
                <label for="brand-name">Brand Name</label>
                <input type="text" class="form-control"  name="brand_name" value="{{ $data->brand_name }}" required>
                <small id="emailHelp" class="form-text text-muted">This is your Brand</small>
            </div>
            <input type="hidden" name="id" value="{{ $data->id }}">

            <div class="form-group">
                <label for="brand-name">Brand Logo</label>
                <input type="file" class="dropify" data-height="140"  name="brand_logo">
                <small id="emailHelp" class="form-text text-muted">This is your Brand Logo</small>
                <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}">  
            </div>  
             
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
    </div>
</form>

{{-- <!-- dropify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script>
    $('.dropify').dropify({
    messages: {
        'default': 'Click Here',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
    });
</script> --}}