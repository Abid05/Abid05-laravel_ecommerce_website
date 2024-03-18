<form action="{{ route('childcategory.update') }}" method="Post" id="add-form">
    @csrf
    <div class="modal-body">

            <div class="form-group">
                <label for="category_name">Category/Subcategory</label>
                <select class="form-control" name="subcategory_id">

                    @foreach ($category as $row)

                        @php
                          $subcat = DB::table('subcategories')->where('category_id','=',$row->id)->get();
                        @endphp

                        <option disabled style="color: red;" value="{{ $row->id }}">{{ $row->category_name }}</option>

                        @foreach ($subcat as $row)
                          <option value="{{ $row->id }}" @if($row->id==$data->subcategory_id) selected @endif> --- {{ $row->subcategory_name }}</option>
                        @endforeach
      
                    @endforeach
                    
                </select> 
                <input type="hidden" name="id" value="{{ $data->id }}">
            </div>

            <div class="form-group">
                <label for="category_name">Child category Name</label>
                <input type="text" class="form-control"  name="childcategory_name" required value="{{ $data->childcategory_name }}">
                <small id="emailHelp" class="form-text text-muted">This is your child category</small>
            </div>     
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary">Update</button>
    </div>
</form>