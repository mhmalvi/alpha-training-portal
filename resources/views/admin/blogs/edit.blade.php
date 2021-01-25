@extends('admin.layouts.app')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/dropzone/basic.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
@endpush

@section('content')
    @isset($data)
        <div class="wrapper wrapper-content">
            <form action="{{route('admin.blog.update', $data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Lets give a title..." value="{{$data->blog_title}}"/>
                                    <cite class="tex-light" style="font-size: 8px; display: block;">*Max 100 characters</cite>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror" style="resize: none;" placeholder="Lets add a summery...">{{$data->blog_summery}}</textarea>
                                    <cite class="tex-light" style="font-size: 8px; display: block;">*Max 255 characters</cite>
                                    @error('summary')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <textarea name="summernote" class="desc" class="form-control">{{$data->blog_details}}</textarea>
                                    @error('summernote')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" data-placeholder="Choose a Country..." class="chosen-select"  tabindex="2">
                                        <option value>Select category...</option>
                                        @isset($categories)
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}" {{($data->category_id == $item->id) ? 'selected' : ''}}>{{$item->category}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="pb-2 d-flex justify-content-center">
                                    <img src="{{asset('storage/app/public/blogs/'.$data->thumbnail)}}" alt="" class="img-thumbnail" id="image-preview" />
                                </div>
                                <div class="form-group">
                                    <label for="image">Upload image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    <cite class="tex-light" style="font-size: 8px; display: block;">*max-upload-size: 2mb</cite>
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end p-3">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endisset
@endsection

@push('js')
    <!-- DROPZONE -->
    <script src="{{asset('assets/admin/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

    {{-- Chosen --}}
    <script src="{{asset('assets/admin/js/plugins/chosen/chosen.jquery.js')}}"></script>

    <script src="{{asset('assets/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});

            function imagePreview(input){
                if(input.files && input.files[0]){
                    var reader =  new FileReader();
                    
                    reader.onload = function(e){
                        $("#image-preview").attr('src', e.target.result).hide().fadeIn('slow');
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#image').change(function(){
                imagePreview(this);
            })

            tinymce.init({
                selector: "textarea.desc",
                
                /* width and height of the editor */
                width: "100%",
                height: 475,
                /* display statusbar */
                statubar: true,
                
                /* plugin */
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],

                /* toolbar */
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                
                /* style */
                style_formats: [
                    {title: "Headers", items: [
                        {title: "Header 1", format: "h1"},
                        {title: "Header 2", format: "h2"},
                        {title: "Header 3", format: "h3"},
                        {title: "Header 4", format: "h4"},
                        {title: "Header 5", format: "h5"},
                        {title: "Header 6", format: "h6"}
                    ]},
                    {title: "Inline", items: [
                        {title: "Bold", icon: "bold", format: "bold"},
                        {title: "Italic", icon: "italic", format: "italic"},
                        {title: "Underline", icon: "underline", format: "underline"},
                        {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
                        {title: "Superscript", icon: "superscript", format: "superscript"},
                        {title: "Subscript", icon: "subscript", format: "subscript"},
                        {title: "Code", icon: "code", format: "code"}
                    ]},
                    {title: "Blocks", items: [
                        {title: "Paragraph", format: "p"},
                        {title: "Blockquote", format: "blockquote"},
                        {title: "Div", format: "div"},
                        {title: "Pre", format: "pre"}
                    ]},
                    {title: "Alignment", items: [
                        {title: "Left", icon: "alignleft", format: "alignleft"},
                        {title: "Center", icon: "aligncenter", format: "aligncenter"},
                        {title: "Right", icon: "alignright", format: "alignright"},
                        {title: "Justify", icon: "alignjustify", format: "alignjustify"}
                    ]}
                ],

                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                },

                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ],
                
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/upload',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }
            })
        })
    </script>
@endpush
