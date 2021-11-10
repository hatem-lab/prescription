<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Hash;
use Auth;
use App\Image;

class UsersController extends Controller {

    /**
    * render and paginate the users page.
    *
    * @return string
    */
    public function index() {
         $users = Admin::latest()->get(); 
        
        return view('dashboard.users.index', compact('users'));
    }

    public function create(){
       
        return view('dashboard.users.create');
    }


    public function store(AdminRequest $request) {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->region = $request->region;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->password = bcrypt($request->password);   
        
        // save the new user data
        if($user->save())
             return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }
    public function edit($id) {

        $user=Admin::find($id);
        return view('dashboard.users.edit',compact('user'));

    }


    public function update(Request $request,$id) {
        $user=Admin::find($id);
        $user->name = $request->name ? $request->name :$user->name;
        $user->email = $request->email ? $request->email :$user->email;
        $user->region = $request->region ? $request->region :$user->region;
        $user->city = $request->city ? $request->city :$user->city;
        $user->phone = $request->phone ? $request->phone :$user->phone;
        $user->user_type = $request->user_type ? $request->user_type :$user->user_type;
        $user->password = bcrypt($request->password);   
       

        // save the new user data
        if($user->save())
             return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }

    public function destroy($id)
    {
        try {
            $user = Admin::find($id);
            if (!$user)
                return redirect()->route('admin.users.index')->with(['error' => 'هذا المستخدم غير موجود ']);
            $user->delete();
            return redirect()->route('admin.users.index')->with(['success' => 'تم  الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.users.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
