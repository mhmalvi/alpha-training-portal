@extends('admin.layouts.app')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="wrapper wrapper-content">
        <form action="{{route('admin.blog.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Lets give a title..." value="{{old('title')}}"/>
                            <cite class="tex-light" style="font-size: 8px; display: block;">*Max 255 characters</cite>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="slug">https://blogs.atr.edu.au/blogs/</span>
                                </div>
                                <input type="text" class="form-control" id="url-slug" name="urlSlug" aria-describedby="slug">
                            </div>
                            <cite class="tex-light" style="font-size: 8px; display: block;">*URL Slug</cite>
                        </div>
                        <div class="form-group">
                            <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror" style="resize: none;" placeholder="Lets add a summery...">{{old('summary')}}</textarea>
                            <cite class="tex-light" style="font-size: 8px; display: block;">*Max 255 characters</cite>
                            @error('summary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                <option value>Select category...</option>
                                @isset($categories)
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <div>
                            <textarea name="summernote" class="desc" class="form-control">{{old('summernote')}}</textarea>
                            @error('summernote')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="form-group">
                            <input type="text" class="form-control" name="meta_tags" id="meta_tags" placeholder="blogs meta tags..."/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="meta_keys" id="meta_keys" placeholder="blogs meta keywords..."/>
                        </div>
                        <div class="form-group">
                            <textarea name="meta_desc" class="form-control" rows="5" style="resize: none;" placeholder="bolgs meta description..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6 pb-2">
                                <h4>Upload Blog Thumbnail</h4>
                                <cite class="tex-light">*max-upload-size: 2mb</cite>
                                <br>
                                <cite class="tex-light">*image-dimension: 822 x 480 px</cite>
                            </div>
                            <div class="col-lg-6">
                                <div id="image"></div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="thumbnail_title" value="{{ old('thumbnail_title') }}" placeholder="Optionally you can put image title..">
                                    @error('thumbnail_title ')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="thumbnail_alt" value="{{ old('thumbnail_alt') }}" placeholder="Optionally you can put image alt..">
                                    @error('thumbnail_alt')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center;">
                    <button type="submit" class="btn btn-outline-primary" onclick="">Publish</button>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('js')
    <script src="{{asset('assets/admin/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/spartan/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('assets/tinymce/tinymce.min.js')}}"></script>
    @include('admin.blogs.scripts')
@endpush