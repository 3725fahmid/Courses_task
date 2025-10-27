@extends('backend.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- Page title -->
        <div class="row mb-3">
            <div class="col-xl-4">
                <div class="page-title-box">
                    <h4 class="title-default display-inline mr-15">All Courses</h4>
                    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">Add New</a>
                </div>
            </div>
        </div>


        <!-- Courses Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all-course-id" /></th>
                                        <th width="25%">Course Title</th>
                                        <th width="30%">Modules & Contents</th>
                                        <th width="10%">Price</th>
                                        <th width="15%">Created</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($courses as $course)
                                    <tr id="course_ids_{{$course->id}}">
                                        <th>
                                            <input type="checkbox" class="course-checkbox" value="{{ $course->id }}" />
                                        </th>
                                        <td>{{ $course->title }}</td>
                                        <td>
                                            @if($course->modules->count())
                                                <ul>
                                                    @foreach($course->modules as $module)
                                                        <li>
                                                            <strong>{{ $module->title }}</strong>
                                                            @if($module->contents->count())
                                                                <ul>
                                                                    @foreach($module->contents as $content)
                                                                        <li>{{ $content->title }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <p>No contents yet</p>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No modules yet</p>
                                            @endif
                                        </td>
                                        <td>{{ $course->price ?? 'Free' }}</td>
                                        <td>{{ $course->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-success btn-sm" title="View"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">No courses found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="text-center mt-3">
                        {{ $courses->appends(request()->input())->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container -->
</div> <!-- page-content -->

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('#select-all-course-id').click(function () {
        $('.course-checkbox').prop('checked', this.checked);
    });

    $('.course-checkbox').change(function () {
        let ids = [];
        $('.course-checkbox:checked').each(function () {
            ids.push($(this).val());
        });
        console.log(ids);
        // optional: AJAX for bulk actions
    });
});
</script>
@endsection
