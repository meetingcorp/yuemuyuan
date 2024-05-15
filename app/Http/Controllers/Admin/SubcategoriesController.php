<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Subproductcategorieses;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subproductcategorieses::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn', function ($data) {
                    $btn = '<a class="btn btn-warning" href="' . route('sub.edit', ['sub' => $data['id']]) . '"><i
                            class="fa fa-pen"
                            data-toggle="tooltip"
                            title="แก้ไข"></i></a>
                            <button class="btn btn-danger" onclick="deleteConfirmation(' . $data["id"] . ')"><i
                            class="fa fa-trash"
                            data-toggle="tooltip"
                            title="ลบข้อมูล"></i></button>';
                    return $btn;
                })
                ->addColumn('switches', function ($data) {
                    if ($data['publish']) {
                        $switches = '<label class="switch">
                                  <input type="checkbox" checked value="0" id="' . $data['id'] . '" onchange="publish(this)">
                                  <span class="slider round"></span>
                                </label>';
                    } else {
                        $switches = '<label class="switch">
                                  <input type="checkbox" value="1" id="' . $data['id'] . '" onchange="publish(this)">
                                  <span class="slider round"></span>
                                </label>';
                    }
                    return $switches;
                })
                ->addColumn('sorting', function ($data) {
                    $sorting = '<input name="sort" type="number" class="form-control"
                    value="' . $data['sort'] . '" id="' . $data['id'] . '" onkeyup="sort(this)">';
                    return $sorting;
                })
                ->rawColumns(['btn', 'switches', 'sorting'])
                ->make(true);
        }
        return view('admin.product.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincategory = ProductCategory::where('publish', '=', 1)->orderBy('sort', 'asc')->get();
        return view('admin.product.subcategory.create', compact('maincategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $sub = new Subproductcategorieses();
        $sub->title = $request->title;
        $sub->categories_id = $request->maincategory;

        if($sub->save()){
            Alert::success('บันทึกข้อมูลสำเร็จ');
            return redirect()->route('sub.index');
        }
        Alert::error('ล้มเหลว');
        return redirect()->route('sub.create');
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
        $maincategory = ProductCategory::where('publish', '=', 1)->orderBy('sort', 'asc')->get();
        $sub = Subproductcategorieses::whereid($id)->first();
        return view('admin.product.subcategory.edit', compact('sub', 'maincategory'));
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
        dd($request);
        $sub = Subproductcategorieses::whereid($id)->first();
        $sub->title = $request->title;
        $sub->categories_id = $request->maincategory;
        $sub->updated_at = Carbon::now();

        if($sub->save()){
            Alert::success('บันทึกข้อมูลสำเร็จ');
            return redirect()->route('sub.index');
        }
        Alert::error('ล้มเหลว');
        return redirect()->route('sub.index');
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
        $page = Subproductcategorieses::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Subproductcategorieses::whereId($id)->first();
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

        $page = Subproductcategorieses::whereId($id)->first();
        $page->sort = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
}
