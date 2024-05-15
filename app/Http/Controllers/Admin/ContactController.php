<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::all();
            return Datatables::make($data)
                ->addIndexColumn()
                ->addColumn('btn', function ($data) {
                    $btn = '<button class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter"
                            data-toggle="tooltip"
                            title="ดูข้อมูล"
                            onclick="readapi(' . $data['id'] . ')">
                            <i class="fa-regular fa-eye"></i></button>
                            <button class="btn btn-danger" onclick="deleteConfirmation(' . $data["id"] . ')"><i
                            class="fa fa-trash"
                            data-toggle="tooltip"
                            title="ลบข้อมูล"></i></button>';
                    return $btn;
                })
                ->addColumn('email', function($data){
                    $email = json_decode($data->data)->email;
                    return $email;
                })
                ->addColumn('createdate', function ($data){ 
                    $createdate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d F Y H:i');
                    return $createdate;
                })
                ->rawColumns(['btn'])
                ->make(true);
        }
        return view('admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Contact::whereId($id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        $page = Contact::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
