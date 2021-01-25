@extends('admin.layouts.app')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <style>
        .devider{
            display: inline;
            padding: 0px 5px;
        }

        .actions a{
            color: #AEB4B7;
        }

        .actions a:hover{
            color: #366B33;
        }

        .table tr td{
            vertical-align: middle !important;
        }
    </style>
@endpush

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>So far you have created!!!</h5>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr class="text-center">
                                <th class="text-left"><input type="checkbox"></th>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Posted at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($blogs)
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($blogs as $blog)
                                @php
                                    $date = date("M d, Y", strtotime($blog->created_at));
                                @endphp
                                    <tr class="text-center">
                                        <td class="text-left"><input type="checkbox"></td>
                                        <td>{{$i++}}</td>
                                        <td class="text-left">
                                            {{$blog->blog_title}}
                                            <div class="row">
                                                <div class="col-md-1 actions">
                                                    <a href="{{route('blogDetail', $blog->blog_slug)}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-1 actions">
                                                    <a href="{{route('admin.blog.edit', Crypt::encryptString($blog->id))}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-1 actions">
                                                    <a href="javascript:void(0)" data-id="{{$blog->id}}" class="del">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if (!$blog->category_id)
                                                {{'uncategorized'}}
                                            @else
                                                {{$blog->category->category}}
                                            @endif
                                        </td>
                                        <td>{{$date}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    {{-- {!! $dataTable->table() !!} --}}
                </div>
                {{-- {!! $dataTable->script() !!} --}}
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
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
                        url: "blog/" + id,
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