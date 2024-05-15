<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Services::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn',function ($data){
                    $btn = '<a class="btn btn-warning" href="'.route('service.edit',['service' => $data['id']]).'"><i
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
                ->addColumn('sorting',function ($data){
                    $sorting = '<input name="sort" type="number" class="form-control"
                    value="'.$data['sort'].'" id="'.$data['id'].'" onkeyup="sort(this)">';
                    return $sorting;
                })
                ->addColumn('img',function ($data){
                    if($data->getFirstMediaUrl('service')){
                        $img = '<img src="'.asset($data->getFirstMediaUrl('service')).'" style="width: auto; height: 30px">';
                    }else{
                        $img = '<img src="'.asset('images/no-image.jpg').'" style="width: auto; height: 30px">';
                    }

                    return $img;
                })
                ->rawColumns(['btn','img','switches','sorting'])
                ->make(true);
        }
        return view('admin.service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'imgs' => 'required|image'
        ]);

        $service = new Services();
        $service->title = $request->title;
        $service->short_detail = $request->shortdetail;
        $service->detail = $request->detail;

        if($service->save()){
			if($request->file('imgs')){
                $getImage = $request->imgs;

                $path = storage_path('app/public');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $getImage = $request->imgs;
                $img = Image::make($getImage->getRealPath());
                $img->resize(1920, 1080, function ($constraint){
                    $constraint->aspectRatio();
                })->save(storage_path('app/public').'/'.$getImage->getClientOriginalName());

                $service->addMedia(storage_path('app/public').'/'.$getImage->getClientOriginalName())->toMediaCollection('service');
            }

            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('service.index');
        }
        return redirect()->back();
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
        $data = Services::whereId($id)->first();
        return view('admin.service.edit', compact('data'));
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
        // $request->validate([
        //     'imgs' => 'required|image'
        // ]);

        $service = Services::whereId($id)->first();
        $service->title = $request->title;
        $service->short_detail = $request->shortdetail;
        $service->detail = $request->detail;

        if($service->save()){
			if($request->file('imgs')){
                $medies = $service->getMedia('service');
                if (count($medies) > 0) {
                    foreach ($medies as $media) {
                        $media->delete();
                    }
                }
				
				$path = storage_path('app/public');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $getImage = $request->imgs;
                $img = Image::make($getImage->getRealPath());
                $img->resize(1920, 1080, function ($constraint){
                    $constraint->aspectRatio();
                })->save(storage_path('app/public').'/'.$getImage->getClientOriginalName());
				
                $service->addMedia(storage_path('app/public').'/'.$getImage->getClientOriginalName())->toMediaCollection('service');
            }

            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('service.index');
        }
        return redirect()->back();
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
        $page = Services::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Services::whereId($id)->first();
        $page->publish = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function sort($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Services::whereId($id)->first();
        $page->sort = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
