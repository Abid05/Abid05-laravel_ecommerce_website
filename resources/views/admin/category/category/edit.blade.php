<!-- Dropify -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"> 

<form action="{{ route('category.update') }}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_add" name="category_name" value="{{ $data->category_name }}" required>
            <small id="emailHelp" class="form-text text-muted">This is your main category</small>
        </div>
        <input type="hidden" name="id" value="{{ $data->id }}">
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Category Icon</label>
            <input type="file" class="form-control dropify" id="icon" name="icon" required>
            <input type="hidden" name="old_icon" required>
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="category_name">Show On Homepage</label>
            <select class="form-control" name="home_page">
                <option value="1" @if($data->home_page ==1) selected @endif>Yes</option>
                <option value="0" @if($data->home_page ==0) selected @endif>No</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
    </div>
</form>

<!-- dropify -->
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
</script>