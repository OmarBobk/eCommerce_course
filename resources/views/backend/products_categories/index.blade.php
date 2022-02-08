@extends('layouts.admin')


@section('content')
    <div class="card shadow mb-4 mx-3">
        {{--Card Header--}}
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary" style="line-height:38px;">
                Product Categories
            </h6>
            <div class="ml-auto">
                <a href="{{route('admin.product_categories.create')}}"
                   class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Category</span>
                </a>
            </div>
        </div>

        @include('backend.products_categories.filter.filter')

        {{--Table--}}
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Product Count</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col" class="text-center" style="width:30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->products_count}}</td>
                            <td>{{$category->parent != null ? $category->parent->name : '-'}}</td>
                            <td>{{$category->status}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('admin.product_categories.edit', $category->id)}}"
                                       class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                       onclick="if(confirm('All Products inside this category will be deleted, Are you sure to delete this Category?')) {document.getElementById('delete-product-category-{{$category->id}}').submit();} else {return false;}"
                                       class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="{{route('admin.product_categories.destroy', $category->id)}}"
                                          method="POST"
                                          class="d-none"
                                          id="delete-product-category-{{$category->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Categories found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="float-right">
                            {!! $categories->links() !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
