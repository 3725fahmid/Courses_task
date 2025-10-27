@extends('backend.admin_master')
@section('admin')


<div class="page-content "> <!-- start:: Main Content -->
    <div class="container-fluid"><!-- start:Container -->

        <!-- start page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="page-title-box">
                    <h4 class="title-default display-inline mr-15">Create a Course</h4>
                    <h6><a class=" text-primary" href="{{url('courses')}}"><i class="ri-arrow-left-s-line"></i><span>back to course</span></a></h6>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-12 mb-3">
                                <label class="form-label">Course Title</label>
                                <input class="form-control" type="text" placeholder="Add Title" name="course_title">
                            </div>
                            <div class="col-xl-6 col-12 mb-3">
                                <label class="form-label">Feature Video</label>
                                <input class="form-control" type="text" placeholder="Add video" name="course_feature_video">
                            </div>
                            <div class="col-xl-4 col-12 mb-3">
                                <label class="form-label">Level</label>
                                <input class="form-control" type="text" placeholder="Add Title" name="course_level">
                            </div>
                            <div class="col-xl-4 col-12 mb-3">
                                <label class="form-label">Select Category</label>
                            
                                    <select class="select2 form-control" name="course_level" data-placeholder="Choose ...">
                                        {{-- @forelse($tags as $tag) --}}
                                        {{-- <option value="{{$tag->id}}">{{$tag->name}}</option> --}}
                                        <option value="1">Bangla</option>
                                        {{-- @empty --}}
    
                                        {{-- @endforelse --}}
                                    </select>
                            </div>
                            <div class="col-xl-4 col-12 mb-3">
                                <label class="form-label">Course Price</label>
                                <input class="form-control" type="text" placeholder="Add Title" name="course_price">
                            </div>
                            <div class="col-12 mb-3">
                                <div class="texteditor">
                                    <label class="form-label">Course Summary</label>
                                    <textarea id="elm1" name="course_summary"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="title">
                                    <button class="btn btn-primary btn-sm mb-3" id="add_new_module">Add Module +</button>
                                </div>
                            </div>
                        </div>
                        <!-- start: model section -->
                        <div class="excerpt" id="module_box">
                            <div id="accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#general_settings" class="text-dark" data-bs-toggle="collapse"
                                                    aria-expanded="false"
                                                    aria-controls="collapseOne">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="m-0">
                                                Module 1
                                                <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="general_settings" class="collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-sm-12 mb-3">
                                                <label class="col-form-label">Model Title</label>
                                                <input class="form-control" type="text" placeholder="Module" name="modules[0][title]">
                                            </div>

                                            <button class="btn btn-primary btn-sm mb-3 add_content_btn">Add Content +</button>

                                            <div class="content_box">
                                                <div class="card content-item mb-3">
                                                    <div class="card-body">
                                                        <div class="col-sm-12 mb-3">
                                                            <label class="col-form-label">Content Title</label>
                                                            <input class="form-control" type="text" placeholder="Content" name="modules[0][contents][]">
                                                        </div>
                                                        {{-- <button class="btn btn-outline-danger btn-sm remove_content_btn">Remove Content</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: Model section -->
                        <input type="submit" class="btn btn-success">
                        <a class="btn btn-danger" href="{{url('courses')}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div> <!-- end:Container -->
</div> <!-- end:: Main Content -->
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


<script>
$(document).ready(function() {
    $('.select2').select2();

    // start from 0 because initial module uses index 0
    let moduleCount = 0;

    $("#add_new_module").click(function(e) {
        e.preventDefault();
        moduleCount++; // new module index

        let accordionId = `accordion_${moduleCount}`;
        let collapseId = `general_settings_${moduleCount}`;
        let headingId = `heading_${moduleCount}`;

        $("#module_box").append(`
            <div id="${accordionId}" class="custom-accordion module-item mb-3" data-module-index="${moduleCount}">
                <button class="btn btn-danger btn-sm mb-3 remove_module_btn float-end">X</button>
                <div class="card">
                    <a href="#${collapseId}" class="text-dark" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="${collapseId}">
                        <div class="card-header" id="${headingId}">
                            <h6 class="m-0">Module ${moduleCount + 1}</h6>
                        </div>
                    </a>
                    <div id="${collapseId}" class="collapse show" aria-labelledby="${headingId}">
                        <div class="card-body">
                            <div class="col-sm-12 mb-3">
                                <label class="col-form-label">Module Title</label>
                                <input class="form-control module-title" type="text" placeholder="Module" name="modules[${moduleCount}][title]">
                            </div>

                            <!-- use class instead of id -->
                            <button class="btn btn-primary btn-sm mb-3 add_content_btn">Add Content +</button>

                            <div class="content_box">
                                <div class="card content-item mb-3">
                                    <div class="card-body">
                                        <div class="col-sm-12 mb-3">
                                            <label class="col-form-label">Content Title</label>
                                            <input class="form-control" type="text" placeholder="Content" name="modules[${moduleCount}][contents][]">
                                        </div>
                                        <button class="btn btn-outline-danger btn-sm remove_content_btn">Remove Content</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.content_box -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.collapse -->
                </div>
                <!-- /.card -->
            </div>
        `);
    });

    // delegate to class .add_content_btn so it works for dynamic elements
    $(document).on('click', '.add_content_btn', function(e) {
        e.preventDefault();

        // find the module wrapper and its index
        let $module = $(this).closest('.module-item');
        // fallback: if not found (shouldn't happen if markup consistent), use nearest card
        if (!$module.length) {
            $module = $(this).closest('.card');
        }
        let moduleIndex = $module.data('module-index');
        if (typeof moduleIndex === 'undefined') {
            // clear debug: assign 0 if undefined
            moduleIndex = 0;
        }

        // find the content_box within the same module
        let contentBox = $module.find('.content_box').first();

        contentBox.append(`
            <div class="card content-item mb-3">
                <div class="card-body">
                    <div class="col-sm-12 mb-3">
                        <label class="col-form-label">Content Title</label>
                        <input class="form-control" type="text" placeholder="Content" name="modules[${moduleIndex}][contents][]">
                    </div>
                    <button class="btn btn-outline-danger btn-sm remove_content_btn">Remove Content</button>
                </div>
            </div>
        `);
    });

    // remove content item
    $(document).on('click', '.remove_content_btn', function(e) {
        e.preventDefault();
        $(this).closest('.content-item').remove();
    });

    // remove entire module
    $(document).on('click', '.remove_module_btn', function(e) {
        e.preventDefault();
        $(this).closest('.module-item').remove();
    });
});
</script>


@endsection

