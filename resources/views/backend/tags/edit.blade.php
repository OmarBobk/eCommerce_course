@extends('layouts.admin')


@section('content')

    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Edit Tag: {{$tag->name}}
            </h6>
            <div class="ml-auto">
                <a href="{{route('admin.tags.index')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Tags</span>
                </a>
            </div>
        </div>

        {{--Form--}}
        <div class="card-body">
            <form action="{{route('admin.tags.update', $tag->id)}}"
                  method="POST">
                @csrf
                @method('PATCH')
                <div class="row">

                    {{--Name--}}
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{old('name', $tag->name)}}"
                                   class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Status--}}
                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status', $tag->status) == 1 ? 'selected' : null}}>
                                Active
                            </option>
                            <option value="0" {{old('status', $tag->status) == 0 ? 'selected' : null}}>
                                Inactive
                            </option>
                        </select>
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection
