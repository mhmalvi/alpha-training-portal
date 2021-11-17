@extends('layouts.app')

@section('title', 'Blogs')

@section('content')
<div class="section-content pvt0">
    <div class="container">
        <div class="row" style="display: flex; justify-content:center;">
            <div class="col-sm-10">
                <div class="blog-list">
                    @if (isset($blogs))
                        @foreach ($blogs as $blog)
                            @php
                                $date = date("M d, Y", strtotime($blog->created_at));
                            @endphp 
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-5">
                                            <a href="{{route('blogDetail', $blog->blog_slug)}}">
                                                <img src="{{asset('storage/blogs/'.$blog->thumbnail)}}" alt="blog" class="img-fluid rounded">
                                            </a>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    <a href="{{route('blogDetail', $blog->blog_slug)}}">
                                                        {{$blog->blog_title}}  
                                                    </a>
                                                </h3>
                                                <p class="card-text">{{$blog->blog_summery}}</p>
                                                <p class="card-text"><small class="text-muted">{{$date}}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 10px 0px;"></div>
                        @endforeach

                        <nav class="blog-pager">
                            @isset($blogs)
                            {{ $blogs->links() }}
                           @endisset
                        </nav>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection