@extends('layouts.app')
@push('seo')
    <meta name="tags" content="{{$blog->meta_tags}}"/>
    <meta name="tags" content="{{$blog->meta_keys}}"/>
    <meta property="og:tags" content="{{$blog->meta_tags}}">
    <meta property="og:keywords" content="{{$blog->meta_keys}}">
    <meta property="og:description" content="{{$blog->meta_desc}}">
    <meta property="og:url" content="https://blogs.atr.edu.au/blogs/{{$blog->blog_slug}}">
    <meta property="og:title" content="{{ $blog->blog_title }}" />
    <meta property="og:image" content="{{asset('storage/app/public/blogs/'.$blog->thumbnail)}}" />
@endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/error/css/style.css')}}">
@endpush
@section('content')
<div class="section-content pvt0">
    @if (isset($blog))
        <div class="container pv5 pvb0 content-single">
            <div class="entry-title">
                <h2  style="text-align: left;">{{$blog->blog_title}}</h2>
            </div>

            <div class="entry-cover-single" data-bg-image="{{asset('storage/blogs/'.$blog->thumbnail)}}"></div>

            <div class="row" style="padding: 20px 0px;">
                <div class="col-sm-3">
                    <div class="entry-desc">
                        <span>If you like it</span>
                        <h4>SHARE THIS PART OF ARTICLE</h4>
                        <p>{{$blog->blog_summery}}</p>
                    </div>
                    <div class="entry-social">
                        <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:;"><i class="fa fa-google-plus"></i></a>
                    </div>
                </div>
                <div class="col-sm-9" style="text-align: justify;">
                    @php
                        echo $blog->blog_details;
                    @endphp
                </div>
            </div>
        </div>
    @else
        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404">
                    <h1>4<span></span>4</h1>
                </div>
                <h2>Oops! Page Not Be Found</h2>
                <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
                <a href="{{route('home')}}">Back to Blog Page</a>
            </div>
        </div>
    @endif
</div>
@endsection