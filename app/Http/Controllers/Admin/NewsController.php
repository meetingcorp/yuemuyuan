<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getwidth(){
        return 1920;
    }

    public function getheight(){
        return 1080;
    }
    
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = News::all();
            return DataTables::make($data)
                ->addIndexColumn() 
                ->addColumn('btn',function ($data){
                    $btn = '<a class="btn btn-warning" href="'.route('news.edit',['news' => $data['slug']]).'"><i
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
                    if($data->getFirstMediaUrl('news')){
                        $img = '<img src="'.asset($data->getFirstMediaUrl('news')).'" style="width: auto; height: 40px">';
                    }else{
                        $img = '<img src="'.asset('images/no-image.jpg').'" style="width: auto; height: 40px">';
                    }

                    return $img;
                })
                ->rawColumns(['btn','img','switches','sorting'])
                ->make(true);
        }
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $news = new News();
        $news->title = $request->title;
        $news->short_detail = $request->shortdetail;
        $news->detail = $request->detail;
        $news->metatag = $request->metatag;
        $news->metadescription = $request->metades;
        $news->created_at = Carbon::now();
        $news->updated_at = Carbon::now();
        if($news->save()){
            if($request->file('imgs')){
                $medies = $news->getMedia('news');
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
				
                $news->addMedia(storage_path('app/public').'/'.$getImage->getClientOriginalName())->toMediaCollection('news');
            }
            Alert::success('เพิ่มข้อมูลแล้ว');
            return redirect()->route('news.index');
        }
        return redirect()->route('news.create');
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
    public function edit(News $news)
    {   
        return view('admin.news.edit', compact('news'));
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
        $news = News::find($id);
        $news->title = $request->title;
        $news->short_detail = $request->shortdetail;
        $news->detail = $request->detail;
        $news->metatag = $request->metatag;
        $news->metadescription = $request->metades;
        $news->updated_at = Carbon::now();
        if($news->save()){
            if($request->file('imgs')){
                $medies = $news->getMedia('news');
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
				
                $news->addMedia(storage_path('app/public').'/'.$getImage->getClientOriginalName())->toMediaCollection('news');
            }
            Alert::success('บันทึกข้อมูลแล้ว');
        }
        return redirect()->route('news.index');
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
        $page = News::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = News::whereId($id)->first();
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

        $page = News::whereId($id)->first();
        $page->sort = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
