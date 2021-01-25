@extends('admin.layouts.app')

@push('css')
    <style>
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            width: 100%;
            border: none;
            border-radius: 0;
            background: #002B46;
            padding: 5px 0px;
        }
        .profile-img .file input {
            opacity: 0;
        }
        .profile-img .file i{
            position: absolute;
            left: 46%;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
@endpush

@section('content')
    <div class="wrapper wrapper-content">
        <div class="container emp-profile">
            <form action="{{route('admin.userProfileUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
                            <img src="{{asset((Auth::user()->profile_photo_path)? 'storage/users/'.Auth::user()->profile_photo_path : 'assets/profile.png')}}" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                <i class="fa fa-camera"></i>
                                <input type="file" name="file" style='width: 100%;'>
                            </div>
                        </div>
                        <small class="text-secondary">*dimention: 300 x 300 | *max-size: 2 MB</small>
                        @error('file')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-head">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <label>User Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="username" class="form-control" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center pt-4">
                    <input type="submit" class="btn btn-outline btn-primary" name="btnAddMore" value="Edit Profile"/>
                </div>
            </form>           
        </div>
    </div>
@endsection