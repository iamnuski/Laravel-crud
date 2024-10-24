@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="d-flex justify-content-between">
            <h5 style="color: black;"><i class="bi bi-journal-richtext"></i> Product details</h5>
            <a href="product/create" class="btn btn-primary"><i class="bi bi-plus-circle"></i> New Product</a>
        </div>
        <p></p>
        <div class="col-md-12 table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>M.R.P</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $index = ($products->currentpage() - 1) * $products->perpage() + $loop->iteration;
                        @endphp


                        <tr>
                            <td class="center">{{ $index }}</td>
                            <td class="center"><img src="products/{{ $product->image }}"
                                    style="width: 50px;height: 50px; object-fit: contain;" alt="Product"></td>
                            <td><a href="product/{{ $product->id }}/show">{{ $product->name }} </a></td>
                            <td>Rs.{{ $product->mrp }}</td>
                            <td>Rs.{{ $product->price }}</td>
                            <td class="center">
                                <a href="product/{{ $product->id }}/edit" class="btn btn-dark btn-sm"><i
                                        class="bi bi-pencil-square"></i></a>
                                <a href="product/{{ $product->id }}/delete"
                                    onclick="return confirm('Are you sure you want to Delete?')"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            {{ $products->links() }}
        </div>
        <!-- row end -->
    </div>
@endsection
