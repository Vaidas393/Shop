<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use Session;

class SectionController extends Controller
{
    public function sections(){
      Session::put('page','sections');
      $sections = Section::get();
      return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request){
      if($request->ajax()){
        $data = $request->all();
        if($data['status']=="Active"){
          $status = 0;
        }else{
          $status = 1;
        }
        Section::where('id',$data["section_id"])->update(["status"=>$status]);
        return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
      }
    }

    public function addEditSection(Request $request, $id=null){
      if($id==""){
        $title = "Add Section";
        $section = new Section;
        $sectiondata = "";
        $message = "Section added";


      }else{
        $title = "Edit Section";
        $sectiondata = Section::where('id',$id)->first();
        $sectiondata = json_decode(json_encode($sectiondata),true);
        $section = Section::find($id);
        $message = "Section updated";

        // echo "<pre>"; print_r($sectiondata); die;




      }

      if($request->isMethod('post')){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $section->name = $data['section_name'];
        $section->status = 1;
        $section->save();

        session::flash('success_message',$message);
        return redirect('admin/sections');
    }
    return view('admin.sections.add_edit_section')->with(compact('title', 'sectiondata'));
  }

  public function deleteSection($id){
    Section::where('id', $id)->delete();
    $message = 'Section deleted';
    session::flash('success_message',$message);
    return redirect()->back();
  }




}
