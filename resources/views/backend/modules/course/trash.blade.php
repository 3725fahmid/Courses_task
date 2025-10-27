@extends('backend.admin_master')
@section('admin')
<style>
.bttn-wrap {
	display: flex;
	gap: 15px;
	margin-bottom: 15px;
}
</style>

<div class="page-content "> <!-- start:: Main Content -->
    <div class="container-fluid"><!-- start:Container -->

    <!-- start page title -->
    <div class="row">
        <div class="col-xl-4">
            <div class="page-title-box">
                <h4 class="title-default display-inline mr-15">All Posts</h4>
                <a href="{{url('posts/create')}}" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 mb-20">
            <div class="rh-links">
                <ul>
                    <li><a href="{{route('posts.index')}}" class="active">All ({{$posts_count}}) | </a></li>
                    <li><a href="{{route('trash.list')}}"> Trash ({{$trash_posts->count()}})</a></li>
                </ul>
            </div>
           
            {{-- <div class="row">
                <div class="col-lg-3 col-xl-3">
                    <div class="rh-select-wrap">
                        <select class="form-select" aria-label="Default select example">
                            <option selected="">Bulk Options</option>
                            <option value="1">Edit</option>
                            <option value="2">Move to Trash</option>
                        </select>
                    </div>
                    <div class="rh-bttn-wrap">
                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                            Apply
                        </button>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-2">
                    <select class="form-select" aria-label="Default select example">
                        <option selected="">All Dates</option>
                        <option value="1">January 2021</option>
                        <option value="1">February 2021</option>
                        <option value="1">March 2021</option>
                    </select>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <div class="rh-select-wrap">
                        <select class="form-select" aria-label="Default select example">
                            <option selected="">All Categories</option>
                            <option value="1">Uncategorized</option>
                        </select>
                    </div>
                    <div class="rh-bttn-wrap">
                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                            Filter
                        </button>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-4">
                    <div class="rh-select-wrap">
                       <input type="search" name="search_string" id="search" class="form-control"/>
                    </div>
                    <div class="rh-bttn-wrap">
                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="bttn-wrap">
                        <div class="bttn-single-item">
                            <form id="bulk-restore-form" action="{{ route('bulk.restore.posts') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info sm rh-btn">
                                    Restore Selected Posts
                                </button>
                            </form>
                        </div>
                        <div class="bttn-single-item">
                            <form id="bulk-delete-form" action="{{ route('bulk.pdelete.posts') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger sm rh-btn">
                                    Delete Selected Posts
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all-trashpost-id"/></th>
                                    <th width="55%">Title</th>
                                    <th>Categories</th>
                                    <th>Date</th>
                                    <th width="30%">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trash_posts as $item)
                                
                                <tr style="opacity:.7">
                                    <td><input type="checkbox" class="trash-post-checkbox" id="post_{{$item->id}}" name="trash_post_ids[]" value="{{ $item->id }}"></td>
                                    <td>{{$item->post_title??''}}</td>
                                    <td>
                                        @foreach ($item->PostCategories as $category)
                                        -{{ $category->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>Published at {{$item->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('restore.post', $item->id)}}" class="btn btn-info sm rh-btn">Restore</a>
                                        <a href="{{route('pdelete.post', $item->id)}}" class="btn btn-danger sm rh-btn">Permanent Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <td colspan="5">No posts found</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                {{ $trash_posts->links() }}
            </div>
        </div>
    </div> <!-- end:Container -->
</div> <!-- end:: Main Content -->

@endsection

@section('scripts')

<script>
   $(document).ready(function () {
    $('#select-all-trashpost-id').click(function () {
        $('.trash-post-checkbox').prop('checked', this.checked);
    });

    $('.trash-post-checkbox').change(function () {
        var ids = [];
        $('.trash-post-checkbox:checked').each(function () {
            ids.push($(this).val());
        });
    });

    // Form submission
    $('#bulk-restore-form').submit(function (e) {
        e.preventDefault(); // Prevent normal form submission
        var trashpostIds = [];

        $('.trash-post-checkbox:checked').each(function () {
            trashpostIds.push($(this).val());
        });

        if (trashpostIds.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select at least one post.'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                _token: '{{ csrf_token() }}',
                trashpostIds: trashpostIds
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                        // Uncheck all checkboxes after restoration
                        $('.trash-post-checkbox').prop('checked', false);
                        $('#select-all-trashpost-id').prop('checked', false);
                    }
                });
            },
            error: function (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.responseJSON.message || 'An error occurred while restoring posts.'
                });
            }
        });
    });
});

// Form submission for bulk permanent delete
    $('#bulk-delete-form').submit(function (e) {
        e.preventDefault(); // Prevent normal form submission
        var trashpostIds = [];

        $('.trash-post-checkbox:checked').each(function () {
            trashpostIds.push($(this).val());
        });

        if (trashpostIds.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select at least one post.'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                _token: '{{ csrf_token() }}',
                post_ids: trashpostIds
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                        $('.trash-post-checkbox').prop('checked', false);
                        $('#select-all-trashpost-id').prop('checked', false);
                    }
                });
            },
            error: function (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.responseJSON.message || 'An error occurred while deleting posts.'
                });
            }
        });
    });

 // Form submission for bulk permanent delete
 $('#bulk-delete-form').submit(function (e) {
        e.preventDefault(); // Prevent normal form submission
        var trashpostIds = [];

        $('.trash-post-checkbox:checked').each(function () {
            trashpostIds.push($(this).val());
        });

        if (trashpostIds.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select at least one post.'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: {
                _token: '{{ csrf_token() }}',
                post_ids: trashpostIds
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                        $('.trash-post-checkbox').prop('checked', false);
                        $('#select-all-trashpost-id').prop('checked', false);
                    }
                });
            },
            error: function (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.responseJSON.message || 'An error occurred while deleting posts.'
                });
            }
        });
    });

</script>

@endsection

