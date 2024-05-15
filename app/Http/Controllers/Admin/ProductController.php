<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Models\ProductCategory;
use App\Models\Subproductcategorieses;
use Image;

class ProductController extends Controller
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
        $cate = ProductCategory::all();
        if($request->ajax()){
            $data = Product::with('product_category')->selectRaw('products.*');
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn',function ($data){
                    $btn = '<a class="btn btn-warning" href="'. route('product.edit',['product' => $data['slug']]).'"><i
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
                                    <input type="checkbox" checked value= "0" id="' . $data['id'] . '" onchange="publish(this)">
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
                    value="'.$data['sort'].'" id="'. $data['id'] . '" onkeyup="sort(this)">';
                    return $sorting;
                })
                ->addColumn('img', function ($data){
                    if($data->getFirstMediaUrl('product')){
                        $img = '<img src="'.$data->getFirstMediaUrl('product').'" style="width: auto; height: 40px;">';
                    }else{
                        $img = '<img src="'.asset('images/no-image.jpg').'" style="width: auto; height: 40px;">';
                    }
                    return $img;
                })
                ->rawColumns(['btn','switches','sorting', 'img'])
                ->make(true);
        }
        return view('admin.product.productall.index', compact('cate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Subproductcategorieses::all();
        return view('admin.product.productall.create',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->sub_categories_id = $request->categorys;
        $product->title = $request->title;
        $product->normal_price = $request->price;
        $product->spacial_price = $request->spacialprice;
        $product->short_detail = $request->shortdetail;
        $product->detail = $request->detail;
        if($request->title1){
            $product->title1 = $request->title1;
        }
        if($request->detail1){
            $product->detail1 = $request->detail1;
        }
        if($request->title2){
            $product->title2 = $request->title2;
        }
        if($request->detail2){
            $product->detail2 = $request->detail2;
        }
        if($request->title3){
            $product->title3 = $request->title3;
        }
        if($request->detail3){
            $product->detail3 = $request->detail3;
        }
        $product->meta_tag = $request->metatag;
        $product->meta_description = $request->metadesc;
        $product->created_at = Carbon::now();
        $product->updated_at = Carbon::now();

        if($product->save()){
            // $product->product_category()->attach($request->categorys);
            if($request->input('image', [])){
                $i = 0;
                $medies_original_name = $request->input('image', []);
                foreach ($request->input('image', []) as $file) {
                    $product->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i+1])
                        ->setName($medies_original_name[$i])
                        ->toMediaCollection('product');
                    $i++;
                }
            }
            
            Alert::success('บันทึกข้อมูล');
            return redirect()->route('product.index');
        }
        Alert::error('ไม่สามารถบันทึกข้อมูลได้');
        return redirect()->route('product.create');
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

    public function edit(Product $product)
    {
        $product = $product;
        $procate = Subproductcategorieses::all();
        $medias = $product->getMedia('product');
        $images = $medias->sortBy(function ($med, $key) {
            return $med->getCustomProperty('order');
        });
        return view('admin.product.productall.edit',compact('product', 'procate', 'images'));
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
        // dd($request);
        $product = Product::whereId($id)->first();
        $product->sub_categories_id = $request->categorys;
        $product->title = $request->title;
        $product->normal_price = $request->price;
        $product->spacial_price = $request->spacialprice;
        $product->short_detail = $request->shortdetail;
        $product->detail = $request->detail;
        $product->title1 = $request->title1;
        $product->detail1 = $request->detail1;
        $product->title2 = $request->title2;
        $product->detail2 = $request->detail2;
        $product->title3 = $request->title3;
        $product->detail3 = $request->detail3;
        $product->meta_tag = $request->metatag;
        $product->meta_description = $request->metadesc;
        $product->updated_at = Carbon::now();
        if($product->save()){
            // $product->product_category()->sync($request->categorys);
            $medies = $product->getMedia('product');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('image', []))) {
                        $media->delete();
                    }
                }
            }

            $i = 1;
            $medies = $product->getMedia('product')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('image', []);

            foreach ($request->input('image', []) as $file) {
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $product->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('product');
                } else {
                    $image = $product->getMedia('product')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                $i++;
            }
            Alert::success('บันทึกสำเร็จ');
            return redirect()->route('product.index');
        }
        return redirect()->route('product.create');
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
        $page = Product::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request){
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Product::whereId($id)->first();
        $page->publish = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function sort($id, Request $request){
        // dd($request->data);
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Product::whereId($id)->first();
        $page->sort = $request->data;
        $page->updated_at = Carbon::now();
        if($page->save()){
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function getdata(ProductCategory $ProductCategory){
        $product = $ProductCategory->products;
        return DataTables::make($product)
        ->addIndexColumn()
        ->addColumn('btn',function ($product){
            $btn = '<a class="btn btn-warning" href="'. route('product.edit',['product' => $product['slug']]).'"><i
                    class="fa fa-pen"
                    data-toggle="tooltip"
                    title="แก้ไข"></i></a>
                    <button class="btn btn-danger" onclick="deleteConfirmation('.$product["id"].')"><i
                    class="fa fa-trash"
                    data-toggle="tooltip"
                    title="ลบข้อมูล"></i></button>';
            return $btn;
        })
        ->addColumn('switches',function ($product){
            if($product['publish']){
                $switches = '<label class="switch">
                            <input type="checkbox" checked value= "0" id="' . $product['id'] . '" onchange="publish(this)">
                            <span class="slider round"></span>
                            </label>';
            }else{
                $switches = '<label class="switch">
                          <input type="checkbox" value="1" id="'.$product['id'].'" onchange="publish(this)">
                          <span class="slider round"></span>
                        </label>';
            }
            return $switches;
        })
        ->addColumn('sorting',function ($product){
            $sorting = '<input name="sort" type="number" class="form-control"
            value="'.$product['sort'].'" id="'. $product['id'] . '" onkeyup="sort(this)">';
            return $sorting;
        })
        ->addColumn('img', function ($product){
            if($product->getFirstMediaUrl('product')){
                $img = '<img src="'.$product->getFirstMediaUrl('product').'" style="width: 75px; height: 80px;">';
            }else{
                $img = '<img src="'.asset('images/no-image.jpg').'" style="width: 75px; height: 80px;">';
            }
            return $img;
        })
        ->rawColumns(['btn','switches','sorting', 'img'])
        ->make(true);
    }
}
