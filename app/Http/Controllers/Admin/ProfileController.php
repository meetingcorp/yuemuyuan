<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    public function show(User $user){
        return view('admin.userprofile.edit', compact('user'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'email' => 'unique:users,email,'.$id,
            'username' => 'unique:users,username,'.$id
        ],[
            'email.unique' => 'มีผู้ใช้งานอีเมลนี้แล้ว',
            'username.unique' => 'มีชื่อผู้ใช้งานนี้แล้ว'
        ]);
        
        $users = User::whereId($id)->first();
        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->mail;
        if($request->pass){
            $users->password = bcrypt($request->pass);
        }
        if($users->save()){
            Alert::success('บันทึกข้อมูล');
        }
        return redirect()->back();
    }
}
