<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function index(Request $request,User $users){
        $users = $users->newQuery();

        if ($request->search != null) {
            $users->where(function($query) use ($request) {
             $query
                ->where( 'username', 'LIKE', "%{$request->search}%" )
                ->orWhere ( 'email', 'LIKE', "%{$request->search}%" )
                ->orWhere ( 'contact', 'LIKE', "%{$request->search}%");
            });
        }

        if($request->roles != null){
            $users->where('roles',$request->roles);
        }

        $users = $users->latest()->paginate(5);
       
        return view('user.listuser',compact('users'));
    }
    public function adduser(){
        return view('user.adduser');
    }
    public function accessdenied(){
        return view('accessdenied');
    }
    public function store(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'contact' => 'required|digits:10',
            'roles' => 'required',
            'terms' => 'required',
        ],
        [
            'username.required'=>'Please enter your User Name',
            'email.required'=>'Please enter your Email',
            'password.required'=>'Please enter your Password',
            'password_confirm.required'=>'Please enter your Confirm Password',
            'contact.required'=>'Please enter your Contact No',
            'roles.required'=>'Please Select Role',
            'terms.required'=>'Please Read and Select Terms & Condition',
        ]);

            $users = new User;

            $users->username = $request->username;
            $users->email = $request->email;
            $users->password = Hash::make($request['password']);
            $users->contact = $request->contact;
            $users->roles = $request->roles;
            //echo "<pre>"; print_r($users); exit;
              $users->save();
              return redirect()->route('listuser')->with('success', 'User Added Successfully.');  
    }
    public function edit($id){
        $users=User::find($id); 
        //$roles = User::get(["name", "id"]);
        return view('user.edituser',compact('users'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'contact' => 'required|digits:10',
            'roles' => 'required',
            'terms' => 'required',
        ],
        [
            'username.required'=>'Please enter your User Name',
            'email.required'=>'Please enter your Email',
            'contact.required'=>'Please enter your Contact No',
            'roles.required'=>'Please Select Role',
            'terms.required'=>'Please Read and Select Terms & Condition',
        ]);
        $users = User::find($id);
        //echo "<pre>"; print_r($users); exit;
            $users->username = $request->username;
            $users->email = $request->email;
            $users->contact = $request->contact;
            $users->roles = $request->roles;
        $users->save();
                return redirect()->route('listuser')->with('success', 'User Updated Successfully.');
    }   
     public function destroy($id){
        $users=User::find($id);  
        $users->delete();
        return redirect()->route('listuser')->with('success', 'User Deleted Successfully.');
        //return redirect()->back()->with('success', 'User Deleted Successfully.');
    }
}
