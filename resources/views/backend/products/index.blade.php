@extends('layouts.admin')


@section('content')
    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Products
            </h6>

            @ability('admin', 'create_products', ['validate_all' => false])
            <div class="ml-auto">
                <a href="{{route('admin.products.create')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Product</span>
                </a>
            </div>
            @endability
        </div>

        @include('backend.products.filter.filter')

        {{--Table--}}
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Featured</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col" class="text-center" style="width:30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>

                                @if($product->firstMedia)
                                <img src="{{asset('assets/products/'.$product->firstMedia->file_name)}}"
                                     width="60"
                                     height="60"
                                     alt="ALt">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->featured()}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->tags->pluck('name')->join(', ')}}</td>
                            <td>{{$product->status()}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{route('admin.products.edit', $product->id)}}"
                                       class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                       onclick="if(confirm('Are you sure you want to delete this Product?')) {document.getElementById('delete-product-{{$product->id}}').submit();} else {return false;}"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </div>
                                <form action="{{route('admin.products.destroy', $product->id)}}"
                                      method="POST"
                                      class="d-none"
                                      id="delete-product-{{$product->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No Products found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="float-right">
                            {!! $products->appends(request()->all())->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
