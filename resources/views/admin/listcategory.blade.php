@extends('layout.layout')


@section('pagetitle')
    List Category
@endsection

@section('maincontent')
    <div class="container mt-5 pt-5 pb-5 bg-white">

        <div class="col-12 mt-5">

            <table id="productsTable" class="table  table-product" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>ID</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="py-0">
                            <img src="images/products/products-xs-01.jpg" alt="Product Image">
                        </td>
                        <td>Coach Swagger</td>
                        <td>24541</td>
                        <td>27</td>
                        <td>1</td>
                        <td><button type="button" class="btn btn-outline-primary btn-square btn-sm">Edit</button></td>
                        <td><button type="button" class="btn btn-outline-danger btn-square btn-sm">Delete</button></td>
                        <td>
                            <div class="dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-display="static">
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
@endsection
