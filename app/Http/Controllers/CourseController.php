<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Eager load modules and their contents to reduce queries
         $courses = Course::with('modules.contents')->paginate(10);

        return view('backend.modules.course.index', compact('courses'));
        // return view('backend.modules.course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.modules.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        // 1️⃣ Create Course
        // $request->validate([
        // 'course_title' => 'required|string|max:255',
        // 'course_level' => 'nullable|string|max:50',
        // 'course_price' => 'nullable|numeric',
        // 'course_feature_video' => 'nullable|string|max:255',
        // 'course_summary' => 'nullable|string',
        // 'modules' => 'nullable|array',
        // 'modules.*.title' => 'required_with:modules|string|max:255',
        // 'modules.*.contents' => 'nullable|array',
        // 'modules.*.contents.*' => 'required|string|max:1000',
        // ]);

        // 2️⃣ Create Course
        $course = Course::create([
            'title' => $request->course_title,
            'level' => $request->course_level,
            'price' => $request->course_price,
            'summary' => $request->course_summary,
            'feature_video' => $request->course_feature_video,
        ]);

        // 3️⃣ Loop through modules
        if (!empty($request->modules)) {
            foreach ($request->modules as $moduleData) {

                // Create Module
                $module = CourseModule::create([
                    'title' => $moduleData['title'] ?? 'Untitled Module',
                ]);

                // Attach module to course (pivot table)
                $course->modules()->attach($module->id);

                // 4️⃣ Create contents for this module
                if (!empty($moduleData['contents'])) {
                    foreach ($moduleData['contents'] as $contentTitle) {
                        $module->contents()->create([
                            'title' => $contentTitle,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //

        // 1️⃣ Find the course
        // $course = Course::findOrFail($id);

        // 2️⃣ Detach and delete related modules + their contents
        foreach ($course->modules as $module) {
            // delete all module contents
            $module->contents()->delete();

            // delete the module itself
            $module->delete();
        }

        // 3️⃣ Detach pivot relation (course_course_module)
        $course->modules()->detach();

        // 4️⃣ Finally, delete the course
        $course->delete();

        $notification = array(
            'message' => 'Course Deleted', 
            'alert-type' => 'Danger'
        );

        // 5️⃣ Redirect back
        return redirect()->route('courses.index')->with($notification);
    }
}
