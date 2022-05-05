@extends('layouts.admin')


@section('content')

    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Update Coupon
            </h6>
            <div class="ml-auto">
                <a href="{{route('admin.product_coupons.index')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Coupons</span>
                </a>
            </div>
        </div>

        {{--Form--}}
        <div class="card-body">
            <form action="{{route('admin.product_coupons.update', $productCoupon->id)}}"
                  method="POST">
                @csrf
                @method('PATCH')
                <div class="row">

                    {{--Code--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" value="{{old('code', $productCoupon->code)}}"
                                   class="form-control">
                            @error('code') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>


                    {{--Type--}}
                    <div class="col-4">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="">---</option>
                            <option value="fixed" {{old('type', $productCoupon->type) == 'fixed' ? 'selected' : null}}>
                                $
                            </option>
                            <option value="percentage" {{old('type', $productCoupon->type) == 'percentage' ? 'selected' : null}}>
                                %
                            </option>
                        </select>
                        @error('type') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    {{--Status--}}
                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status', $productCoupon->status) == 1 ? 'selected' : null}}>
                                Active
                            </option>
                            <option value="0" {{old('status', $productCoupon->status) == 0 ? 'selected' : null}}>
                                Inactive
                            </option>
                        </select>
                        @error('status') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    {{--Value--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" value="{{old('value', $productCoupon->value)}}"
                                   class="form-control">
                            @error('value') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Use Times--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="use_times">Use Times</label>
                            <input type="number" name="use_times" value="{{old('use_times', $productCoupon->use_times)}}"
                                   class="form-control">
                            @error('use_times') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Start Date--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" value="{{old('start_date', $productCoupon->start_date->format('Y-m-d'))}}"
                                   min="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                   class="form-control">
                            @error('start_date') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Expire Date--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="expire_date">Expire Date</label>
                            <input type="date" name="expire_date"
                                   value="{{old('expire_date', $productCoupon->expire_date->format('Y-m-d'))}}"
                                   min="{{\Carbon\Carbon::now()->addDay()->format('Y-m-d')}}"
                                   class="form-control">
                            @error('expire_date') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Greater Than--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="greater_than">Greater Than</label>
                            <input type="number" name="greater_than" value="{{old('greater_than', $productCoupon->greater_than)}}"
                                   class="form-control">
                            @error('greater_than') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>

                    {{--Description--}}
                    <div class="col-4">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control">{{old('description', $productCoupon->description)}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
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
