<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Session;
use Hash;
use Image;

class AdminController extends Controller
{
    // display dashboard
    public function dashboard(){
      // Session::put('page','dashboard');
      return view('admin.admin_dashboard');
    }

    // display settings(for password change)
    public function settings(){
      // echo "<pre>"; print_r(Auth::guard('admin')->user()); die; (in case you want print all details)
      return view('admin.admin_settings');
    }

    // admin login
    public function login(Request $request){
      if($request->isMethod('post')){
        $data = $request->all();

        $rules = [
          'email' => 'required|email|max:255',
          'password' => 'required',
        ];

        $customMessages = [
          'email.required' => 'Email missing',
          'email.email' => 'This is not valid Email type',
          'password.required' => 'The password is missing or wrong',
        ];

          $this->validate($request,$rules,$customMessages);

          if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('admin/dashboard');
          }else{
            Session::flash('errors_message', 'Invalid Email or Password');
            return redirect()->back();
          }
      }
      return view('admin.admin_login');
    }

    // logout admin
    public function logout(){
      Auth::guard('admin')->logout();
      return redirect('/admin');
    }

    public function checkCurrentPassword(Request $request){
      $data = $request->all();
      // echo "<pre>";print_r(Auth::guard('admin')->user()->password); die;
      if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
      echo "true";
    }else{
      echo "false";
    }
  }

  public function updateCurrentPassword(Request $request){
    if($request->isMethod("post")){
      $data = $request->all();
      if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
        if($data['new_pwd']==$data['confirm_pwd']){
          Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
          Session::flash('success_message', 'Password updated');
        }else{
          Session::flash('error_message', 'Passwords do not match');
        }
    }else{
      Session::flash('error_message', 'Current password incorect');
    }
    return redirect()->back();

    }
  }

  public function updateAdminDetails(Request $request){
    if($request->isMethod("post")){
      $data = $request->all();

      $rules = [
        'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
        'admin_mobile' => 'numeric',
        'admin_image' => 'image',
      ];

      $customAdminMessages = [
        'admin_name.required' => 'Name is required',
        'admin_name.regex' => 'Invalid name',
        'admin_mobile.numeric' => 'Phone number invalid',
        'admin_image' => 'Image type invalid',
      ];

      $this->validate($request,$rules,$customAdminMessages);

        if($request->hasfile('admin_image')){
          $image_tmp = $request->file('admin_image');
          if($image_tmp->isValid()){
            $extension = $image_tmp->getClientOriginalExtension();
            $imageName = 'adminProfilePicture'.'.'.$extension;
            $imagePath ='images/admin_images/'.$imageName;
            Image::make($image_tmp)->resize(400,500)->save($imagePath);

          }elseif (!empty($data['current_admin_image'])) {
            $imageName = $data['current_admin_image'];
          }else {
            $imageName = "";
          }
        }

        Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image'=>$imageName]);
        session::flash('success_details_message','Info updated');
        return redirect()->back();

    }
    return view('admin.admin_settings');
  }

} //admin controller class end
