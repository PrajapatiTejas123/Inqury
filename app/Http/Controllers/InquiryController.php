<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class InquiryController extends Controller
{
    public function index(Request $request,Inquiry $inquirys){
        $inquirys = $inquirys->newQuery();
                if($request->search != null){
                    $inquirys->where(function($query) use($request) {
                     $query->where ( 'firstname', 'LIKE', "%{$request->search}%" )->orWhere ( 'lastname', 'LIKE', "%{$request->search}%" )->orWhere ( 'email', 'LIKE', "%{$request->search}%" );
                        });
                    }
                if($request->status != null){
                    $inquirys->where('status',$request->status);
                }

            $inquirys = $inquirys->latest()->paginate(5);
       
            return view('inquiry.listinquiry',compact('inquirys'));
    }

    // public function index(Request $request,Inquiry $inquiry){
    //     $inquiry = $inquiry->newQuery();
    //     //$search = $request['search'] ?? "";
    //     if ($request->search != null){
    //         $inquiry->where(function($query) use($request) {
    //                  $query->where ( 'firstname', 'LIKE', "%{$request->search}%" )->orWhere ( 'lastname', 'LIKE', "%{$request->search}%" )->orWhere ( 'email', 'LIKE', "%{$request->search}%" );
    //                     });
            
    //     }
    //     $inquiry = Inquiry::orderBy('id','desc')->paginate(5);  
    //     return view('inquiry.listinquiry',compact('inquiry'));
    // }

    public function addinquiry(){
        return view('inquiry.addinquiry');
    }
    public function store(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:inquiries',
            'contact' => 'required|digits:10',
            'address' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ],
        [
            'firstname.required'=>'Please enter First Name',
            'lastname.required'=>'Please enter Last Name',
            'email.required'=>'Please enter Email',
            'contact.required'=>'Please enter Contact',
            'address.required'=>'Please enter Address',
            'title.required'=>'Please enter Title',
            'description.required'=>'Please enter Description',
            'status.required'=>'Please Select Status'
        ]);

            $users = new Inquiry;
            // echo "<pre>"; print_r("expression"); exit;
            $users->firstname = $request->firstname;
            $users->lastname = $request->lastname;
            $users->email = $request->email;
            $users->contact = $request->contact;
            $users->address = $request->address;
            $users->title = $request->title;
            $users->description = $request->description;
            $users->status = $request->status;
            //echo "<pre>"; print_r($users); exit;
            $users->save();
            return redirect()->route('listinquiry')->with('success', 'Inquiry Added Successfully.');  
    }
    public function edit($id){
        $users=Inquiry::find($id); 
        return view('inquiry.editinquiry',compact('users'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'contact' => 'required|digits:10',
            'address' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ],
        [
            'firstname.required'=>'Please enter First Name',
            'lastname.required'=>'Please enter Last Name',
            'email.required'=>'Please enter Email',
            'contact.required'=>'Please enter Contact',
            'address.required'=>'Please enter Address',
            'title.required'=>'Please enter Title',
            'description.required'=>'Please enter Description',
            'status.required'=>'Please Select Status'
        ]);
        $users = Inquiry::find($id);
            $users->firstname = $request->firstname;
            $users->lastname = $request->lastname;
            $users->email = $request->email;
            $users->contact = $request->contact;
            $users->address = $request->address;
            $users->title = $request->title;
            $users->description = $request->description;
            $users->status = $request->status;
            $users->save();
                return redirect()->route('listinquiry')->with('success', 'Inquiry Updated Successfully.');
    }
    public function destroy($id){
        $users=Inquiry::find($id);  
        $users->delete();
        return redirect()->route('listinquiry')->with('success', 'Inquiry Deleted Successfully.');
    }
}
