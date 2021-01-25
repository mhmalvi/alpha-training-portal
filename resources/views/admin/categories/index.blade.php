@extends('admin.layouts.app')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Add New Category</h4>

                        <form action="{{route('admin.category.add')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="category" class="form-control" placeholder="Enter new category here...">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>So far you have created!!!</h5>
                    </div>
                    <div class="ibox-content">
        
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="categories">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left"><input type="checkbox"></th>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Category</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($data as $row)
                                    @php
                                        $date = date("M d, Y", strtotime($row->created_at));
                                    @endphp
                                    <tr class="text-center">
                                        <td class="text-left"><input type="checkbox"></td>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline btn-primary edit" data-id="{{Crypt::encryptString($row->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline btn-danger del" data-id="{{$row->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>{{$row->category}}</td>
                                        <td>{{$date}}</td>
                                    </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.edit')
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#categories').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });
    </script>

    <script>
        $(document).ready(function(){
            $('.edit').on('click', function(){
                var id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "categories/" + id + "/edit",
                    method: 'GET',
                    dataType: "json",
                    success: function(data){
                        if(data){
                            var category = data.category;
                            var catId = data.id;

                            $("#id").val(catId);
                            $("#category").val(category);
                            $("#categoryEdit").modal('show');
                        }
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready(function(){
            $('.del').on('click', function(){
                var id = $(this).data('id');
                // $('.dataTables-example').DataTable().ajax.reload();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if(confirm('Are you sure to delete?')){
                        $.ajax({
                        url: "categories/" + id,
                        method: 'DELETE',
                        success: function(data){
                            if(data['status'] == 200){
                                location.reload(true);
                            }
                        }
                    })
                }
            })
        })
    </script>
@endpush