@extends('backend.admin_master')
@section('admin')


<div class="page-content "> <!-- start:: Main Content -->
    <div class="container-fluid"><!-- start:Container -->

        <!-- start page title -->
        <div class="row">
            <div class="col-xl-4">
                <div class="page-title-box">
                    <h4 class="title-default display-inline mr-15">Edit Post</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <form action="{{route('posts.update',$post)}}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-9 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="col-sm-12">
                                <input class="form-control" type="text" placeholder="Add Title" name="post_title" value="{{$post->post_title}}">
                            </div>
                            <div class="col-sm-12 mt-15">
                               <span>Permalink: <a href="#" style="color:#2F84EA">{{asset('/')}}</a><input style="width:50%" type="text" value="{{$post->post_slug}}" name="post_slug"></span>
                                @error('post_slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="texteditor">
                            <textarea id="elm1" name="post_content">{{$post->post_content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- start: genarel settings -->
                        <div class="excerpt">
                            <div id="accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#general_settings" class="text-dark" data-bs-toggle="collapse"
                                                    aria-expanded="false"
                                                    aria-controls="collapseOne">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="m-0">
                                                General Settings
                                                <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="general_settings" class="collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="col-sm-12 mb-3">
                                                <label for="example-text-input" class="col-form-label">Page Banner</label>
                                                <div class="col-sm-12">
                                                    <input name="page_banner" class="form-control" type="file"  id="page_banner">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="col-sm-6">
                                                    <img class="image-resize-backend" id="show_page_banner" src="{{(!empty($post->page_banner))?url($post->page_banner):url('upload/no_image.jpg') }}" alt="Image">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <label for="page_title" class="col-form-label">Page Title</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text" name="page_title" value="{{$post->page_title}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <label for="banner_text" class="col-form-label">Banner Text</label>
                                                <div class="col-sm-12">
                                                    <textarea  class="form-control" rows="3" name="banner_text">{{$post->banner_text}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: genarel settings -->
                        <!-- start: Additional Info -->
                        {{-- <div class="excerpt">
                            <div id="accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#additional_info" class="text-dark" data-bs-toggle="collapse"
                                                    aria-expanded="false"
                                                    aria-controls="collapseOne">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="m-0">
                                                Additional Info 
                                                <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="additional_info" class="collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <textarea  class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- end: Additional Info -->
                        <!-- start: short description -->
                        <div class="excerpt">
                            <div id="accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#post_excerpt" class="text-dark" data-bs-toggle="collapse"
                                                    aria-expanded="true"
                                                    aria-controls="collapseOne">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="m-0">
                                                Short Description
                                                <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                            </h6>
                                        </div>
                                    </a>

                                    <div id="post_excerpt" class="collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <textarea  class="form-control" rows="3" name="post_excerpt">{{$post->post_excerpt}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: short description -->
                    </div>
                </div>
            </div>
          
           
            
            <div class="col-lg-3 col-xl-3">
                <div class="sidebar">
                    <div id="accordion" class="custom-accordion">
                        <div class="card">
                            <a href="#publish" class="text-dark" data-bs-toggle="collapse"
                                            aria-expanded="true"
                                            aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h6 class="m-0">
                                        Publish
                                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                    </h6>
                                </div>
                            </a>

                            <div id="publish" class="collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <div class="">
                                        <ul>
                                            <li><b>Status:</b><br>
                                            <fieldset>
                                                @if($post->post_status == $post->post_status)
                                                <input type="radio" name="post_status" value="1" {{ $post->post_status == '1' ? 'checked' : ''}}>
                                                <label for="active">Active</label><br>
                                                <input type="radio" name="post_status" value="0" {{ $post->post_status == '0' ? 'checked' : ''}}>
                                                <label for="Inactive">Inactive</label>
                                                @endif
                                            </fieldset>
                                            <li>Order: <input class="form-control" type="text" name="post_order_by" value="{{$post->post_order_by}}"></li>
                                            <li>Publish: <strong>Immediately </strong><a href="#"  style="color:#2F84EA">Edit</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-foot" style="">
                                        <button type="submit" class="btn btn-sm btn-primary btn-primary waves-effect waves-light">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <a href="#categories" class="text-dark" data-bs-toggle="collapse"
                                            aria-expanded="true"
                                            aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h6 class="m-0">
                                        Categories
                                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                    </h6>
                                </div>
                            </a>

                            <div id="categories" class="collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="card-body ">
                                    <ul>
                                        
                                        @foreach($categories as $category)
                                        <li><input class="" type="checkbox" name="post_category_id[]" value="{{$category->id}}" @foreach($post_post_categories as $rPermission) {{$category->id == $rPermission->post_category_id ? 'checked':''}} @endforeach />{{$category->name}}
                                            <ul>
                                                @foreach($category->children as $child)
                                                <li><input type="checkbox" name="post_category_id[]" value="{{$child->id}}" @foreach($post_post_categories as $rPermission) {{$child->id == $rPermission->post_category_id ? 'checked':''}} @endforeach/>{{$child->name}}
                                                <ul>
                                                    @foreach($child->children as $child2)
                                                    <li><input type="checkbox" name="post_category_id[]" value="{{$child2->id}}" @foreach($post_post_categories as $rPermission) {{$child2->id == $rPermission->post_category_id ? 'checked':''}} @endforeach/>{{$child2->name}}
                                                    @endforeach
                                                </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                         <!-- start::tags -->
                         <div class="card">
                            <a href="#tags" class="text-dark" data-bs-toggle="collapse"
                                            aria-expanded="true"
                                            aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h6 class="m-0">
                                        Tags
                                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                    </h6>
                                </div>
                            </a>
                            <div id="tags" class="collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="card-body ">
                                    <div>
                                        <label class="form-label">Multiple Select</label>
                        
                                        <select class="select2 form-control select2-multiple"
                                            multiple="multiple" data-placeholder="Choose ..." name="post_tag_id[]">
                                            @forelse($tags as $tag)
                                            <option value="{{ $tag->id }}" @foreach($post_tags as $ptag) {{$tag->id == $ptag->post_tag_id ? 'selected':''}} @endforeach>
                                                {{ $tag->name }}
                                            </option>
                                        @empty
                                            <option value="">No Tags Available</option>
                                        @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end::tags -->
                        <div class="card">
                            <a href="#featuredimage" class="text-dark" data-bs-toggle="collapse"
                                            aria-expanded="true"
                                            aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h6 class="m-0">
                                        Featured Image
                                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                    </h6>
                                </div>
                            </a>
                            <div id="featuredimage" class="collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="card-body">
                                    <input name="featured_image" class="form-control mb-3" type="file"  id="user_image">
                                    <img id="showUserImage" class="rounded avatar-lg" src="{{(!empty($post->featured_image))? url($post->featured_image):url('upload/no_image.jpg') }}" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </form>
    </div> <!-- end:Container -->
</div> <!-- end:: Main Content -->
@endsection
