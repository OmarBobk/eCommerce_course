@extends('layouts.admin')


@section('content')
    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Product Coupons
            </h6>

            @ability('admin', 'create_product_coupons', ['validate_all' => false])
            <div class="ml-auto">
                <a href="{{route('admin.product_coupons.create')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Coupon</span>
                </a>
            </div>
            @endability
        </div>

        @include('backend.products_coupons.filter.filter')

        {{--Table--}}
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>
                    <th scope="col">Status</th>
                    <th scope="col">Use Times</th>
                    <th scope="col">Validity date</th>
                    <th scope="col">Greater Than</th>
                    <th scope="col">Created At</th>
                    <th scope="col" class="text-center" style="width:30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->value}}  {{$coupon->type == 'fixed' ? '$' : '%'}}</td>
                            <td>{{$coupon->status()}}</td>
                            <td>{{$coupon->used_times . ' / ' . $coupon->use_times }}</td>
                            <td>
                                {{$coupon->start_date != '' ? $coupon->start_date->format('Y-m-d').' - '. $coupon->expire_date->format('Y-m-d') : ''}}
                            </td>
                            <td>{{$coupon->greater_than ?? '-'}}</td>
                            <td>{{$coupon->created_at->format('Y-m-d h:i a')}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('admin.product_coupons.edit', $coupon->id)}}"
                                       class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                       onclick="if(confirm('Are you sure to delete this Coupon?')) {document.getElementById('delete-product-coupon-{{$coupon->id}}').submit();} else {return false;}"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                                <form action="{{route('admin.product_coupons.destroy', $coupon->id)}}"
                                      method="POST"
                                      class="d-none"
                                      id="delete-product-coupon-{{$coupon->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Coupons found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="float-right">
                            {!! $coupons->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
