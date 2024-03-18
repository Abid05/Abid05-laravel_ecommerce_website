@php
  $color=explode(',',$product->color);
  $sizes=explode(',',$product->size);
@endphp

<div class="modal-body">
  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-4">
              <div>
                  <img src="{{ asset('files/product/' . $product->thumbnail) }}" height="100%" width="100%">
              </div>
          </div>
          <div class="col-lg-8 ">
              <h3>{{ $product->name }}</h3>
              <p>{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
              <p>Brand: {{ $product->brand->brand_name }}</p>
              <p>Stock: @if ($product->stock_quantity < 1) <span class="badge badge-danger">Stock Out</span> @else <span class="badge badge-success">Stock Available</span> @endif</p>
              <div>
                  @if ($product->discount_price == null)
                      <div>Price: {{ $setting->currency }}{{ $product->selling_price }}</div>
                  @else
                      <div>
                          Price: <del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del>
                          {{ $setting->currency }}{{ $product->discount_price }}
                      </div>
                  @endif
              </div>
              <br>
              <div class="order_info">
                  <form action="#">
                      <div class="form-group">
                          <div class="row">
                              @isset($product->size)
                                  <div class="col-lg-6">
                                      <label>Size: </label>
                                      <select class="custom-select form-control-sm" name="size" style="min-width: 120px; ">
                                          @foreach ($sizes as $size)
                                              <option value="{{ $size }}">{{ $size }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              @endisset

                              @isset($product->color)
                                  <div class="col-lg-6">
                                      <label>Color:</label>
                                      <select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                                          @foreach ($color as $row)
                                              <option value="{{ $row }}">{{ $row }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              @endisset
                          </div>
                      </div>
                      <div class="button_container">
                          <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  @if($product->stock_quantity<1)
                                      <span class="text-danger">Stock Out</span>
                                  @else
                                      <button class="btn btn-sm btn-outline-info" type="submit" style="float: right;">Add to cart</button>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
