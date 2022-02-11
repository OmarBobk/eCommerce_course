@extends('layouts.admin')


@section('content')

    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Create Product
            </h6>
            <div class="ml-auto">
                <a href="{{route('admin.products.index')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Products</span>
                </a>
            </div>
        </div>

        {{--Form--}}
        <div class="card-body">
            <form action="{{route('admin.products.store')}}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">

                    {{--Name--}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name')}}"
                                   class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>


                    {{-- Category --}}
                    <div class="col-3">
                        <label for="product_category_id">Category</label>
                        <select name="product_category_id" class="form-control">
                            <option value="">---</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}" {{old('product_category_id') == $category->id ? 'selected' : null}}>
                                    {{$category->name}}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        @error('product_category_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    {{--Status--}}
                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status') == '1' ? 'selected' : null}}>
                                Active
                            </option>
                            <option value="0" {{old('status') == '0' ? 'selected' : null}}>
                                Inactive
                            </option>
                        </select>
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>


                {{--Descripn--}}
                <div class="row">
                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3">{!! old('description')!!}</textarea>
                    </div>
                </div>

                <div class="row">
                    {{--Quantity--}}
                    <div class="col-4">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity"
                               value="{{old('quantity')}}"
                               class="form-control">
                        @error('quantity') <span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    {{--Price--}}
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="text" name="price"
                               value="{{old('price')}}"
                               class="form-control">
                        @error('price') <span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    {{--Featured--}}
                    <div class="col-4">
                        <label for="featured">Featured</label>
                        <select name="featured" class="form-control">
                            <option value="1" {{old('featured') == 1 ? 'selected' : null}}>
                                Yes
                            </option>
                            <option value="0" {{old('featured') == 0 ? 'selected' : null}}>
                                No
                            </option>
                        </select>
                        @error('featured') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                {{--Tags--}}
                <div class="row">
                    <div class="col-12">
                        <label for="description">Tags</label>
                        <select name="tags" multiple class="form-control">
                            @forelse($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                {{--Images--}}
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="images">Images</label>
                        <br>
                        <div class="file-load">
                            <input type="file" name="images[]"
                                   multiple="multiple"
                                   id="product-images" class="file-input-overview"
                            >
                            @error('images') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Add Product
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
