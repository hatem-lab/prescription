<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


use App\Models\CourseType;
use Illuminate\Http\Request;
use DB;

class CourseTypeController extends Controller
{

    public function index()
    {
        $courses = CourseType::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('dashboard.courses.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

           
            $course = CourseType::create($request->except('_token'));
        $course->save();
        DB::commit();
        return redirect()->route('admin.courses')->with(['success' => 'تم ألاضافة بنجاح']);
    }

    public function edit($id)
    {
        $course = CourseType::find($id);
       
        if (!$course)
            return redirect()->route('admin.courses')->with(['error' => 'هذا الماركة غير موجود ']);

        return view('dashboard.courses.edit', compact('course'));

    }
    public function update($id, Request $request)
    {  
        try {

            //update DB
            $course = CourseType::find($id);
            if (!$course)
                return redirect()->route('admin.courses')->with(['error' => 'هذا الماركة غير موجود']);
            DB::beginTransaction();
            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $course->update($request->except('_token', 'id'));

            

            DB::commit();
            return redirect()->route('admin.courses')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.courses')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function destroy($id)
    {
        try {
            $course = CourseType::find($id);

            if (!$course)
                return redirect()->route('admin.courses')->with(['error' => 'هذا الكورس غير موجود ']);

            $course->delete();

            return redirect()->route('admin.courses')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.courses')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
