@extends('layouts.app')

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
                                <a href="{{route('blogDetail', $blog->blog_slug)}}">
                                    <div class="card mb-3">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <img src="{{asset('storage/blogs/'.$blog->thumbnail)}}" alt="blog" class="border_radius" style="max-width: 320px;">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <h3 class="card-title">{{$blog->blog_title}}</h3>
                                                    <p class="card-text">{{$blog->blog_summery}}</p>
                                                    <p class="card-text"><small class="text-muted">{{$date}}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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