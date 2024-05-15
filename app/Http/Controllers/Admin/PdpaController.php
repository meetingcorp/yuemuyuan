<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pdpa;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class PdpaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Pdpa::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn',function ($data){
                    $btn = '<a class="btn btn-warning" href="'.route('pdpa.edit',['pdpa' => $data['id']]).'"><i
                            class="fa fa-pen"
                            data-toggle="tooltip"
                            title="แก้ไข"></i></a>
                            <button class="btn btn-danger" onclick="deleteConfirmation('.$data["id"].')"><i
                            class="fa fa-trash"
                            data-toggle="tooltip"
                            title="ลบข้อมูล"></i></button>';
                    return $btn;
                })
                ->addColumn('switches',function ($data){
                    if($data['publish']){
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
                ->addColumn('selection', function ($data) {
                    if($data['publish']){
                        $selection = '<input type="radio" onclick="publish(this)" id="'.$data['id'].'" value="1" name="sec" checked>';
                    }else{
                        $selection = '<input type="radio" onclick="publish(this)" id="'.$data['id'].'" value="1" name="sec">';
                    }
                    return $selection;
                })
                ->addColumn('policies', function($data) {
                    return '<p>'.strtolower(Str::limit($data['policys'], 10)).'</p>';
                })
                ->addColumn('cookies', function($data) {
                    return Str::limit($data['cookies'], 50);
                })
                ->rawColumns(['btn', 'switches', 'cookies', 'policies', 'selection'])
                ->make(true);
            }
        return view('admin.pdpa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pdpa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pdpa = new Pdpa();
        $pdpa->cookies = $request->post('cookies');
        $pdpa->policys = $request->post('policies');
        $pdpa->title = $request->post('title');
        if($pdpa->save()){
            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('pdpa.index');
        }
        Alert::error('ผิดพลาด');
        return redirect()->route('pdpa.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pdpa = Pdpa::whereId($id)->first();
        return view('admin.pdpa.edit', compact('pdpa'));
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
        $pdpa = Pdpa::whereId($id)->first();
        $pdpa->cookies = $request->post('cookies');
        $pdpa->policys = $request->post('policies');
        $pdpa->title = $request->post('title');
        if($pdpa->save()){
            Alert::success('บันทึกข้อมูลสำเร็จ');
            return redirect()->route('pdpa.index');
        }
        Alert::error('ผิดพลาด');
        return redirect()->route('pdpa.store');
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
        $page = Pdpa::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
    public function publish($id){
        // set old obj = 0
        $status = false;
        $message = 'เกิดข้อผิดพลาด';
        $old = Pdpa::where('publish', '=', 1)->first();

        if($old){
            $old->publish = 0;

            if($old->save()){
                $newpdpa = Pdpa::whereId($id)->first();
                $newpdpa->publish = 1;
                if($newpdpa->save()){
                    $status = true;
                    $message = 'เปลี่ยนแบบฟอร์มแล้ว';
                }
            }

        }else{
            $newpdpa = Pdpa::whereId($id)->first();
            $newpdpa->publish = 1;
            if($newpdpa->save()){
                $status = true;
                $message = 'เปลี่ยนแบบฟอร์มแล้ว';
            }
        }
        
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
