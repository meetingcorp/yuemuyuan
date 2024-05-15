<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){

            if(Auth::user()->hasRole('supreme administrator')){
                $data = User::all();
            }else{
                $data = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->where('model_has_roles.role_id', '!=', '1')
                ->get();
            }

            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn',function ($data){
                    $btn = '<a class="btn btn-warning" href="'.route('users.edit',['user' => $data['id']]).'"><i
                            class="fa fa-pen"
                            data-toggle="tooltip"
                            title="แก้ไข"></i></a>
                            <button class="btn btn-danger" onclick="deleteConfirmation('.$data['id'].')"><i
                            class="fa fa-trash"
                            data-toggle="tooltip"
                            title="ลบข้อมูล"></i></button>';
                    return $btn;
                })
                ->addColumn('switches',function ($data){
                    if($data['is_admin']){
                        $switches = '<label class="switch">
                                  <input type="checkbox" checked value="0" id="'.$data['id'].'" onchange="publish(this)">
                                  <span class="slider round"></span>
                                </label>';
                    }else{
                        $switches = '<label class="switch">
                                  <input type="checkbox" value="1" id="'.$data['id'].'" onchange="publish(this)">
                                  <span class="slider round"></span>
                                </label>';
                    }
                    return $switches;
                })
                ->rawColumns(['btn', 'switches'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
            'username' => 'unique:users'
        ],[
            'email.unique' => 'มีผู้ใช้งานอีเมลนี้แล้ว',
            'username.unique' => 'มีชื่อผู้ใช้งานนี้แล้ว'
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->is_admin = 1;
        $users->password = bcrypt($request->password);
        $users->created_at = Carbon::now();
        $users->updated_at = Carbon::now();

        if($users->save()){
            $users->assignRole($request->userrole);
            Alert::success('บันทึกข้อมูล');
            return view('admin.user.index');
        }

        Alert::error('ผิดพลาด');
        return view('admin.user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.userprofile.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $detail = User::whereId($id)->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->get();
        $detail = $detail[0];
        return view('admin.user.edit', compact('detail','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'email' => 'unique:users,email,'.$id,
            'username' => 'unique:users,username,'.$id
        ],[
            'email.unique' => 'มีผู้ใช้งานอีเมลนี้แล้ว',
            'username.unique' => 'มีชื่อผู้ใช้งานนี้แล้ว'
        ]);
        
        $users = User::find($id);
        if($request->password != null){
            $users->password = bcrypt($request->password);
        }
        $users->username = $request->username;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->updated_at = Carbon::now();
        if($users->save()){
            $users->removeRole($users->roles()->get()[0]->name);
            $users->assignRole($request->userrole);
            Alert::success('บันทึกข้อมูล');
        }
        return view('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = false;
        $message = 'ไม่สามารถลบข้อมูลได้';

        $page = User::whereId($id)->first();
        $page->removeRole($page->roles()->get()[0]->name);

        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = User::whereId($id)->first();
        $page->is_admin = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

}
