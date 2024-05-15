<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Image;
use File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::all();
            return DataTables::make($data)
                ->addIndexColumn()
                ->addColumn('btn', function ($data) {
                    $btn = '<a class="btn btn-warning" href="' . route('project.edit', ['project' => $data['id']]) . '"><i
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
                ->addColumn('img', function ($data) {
                    if ($data->getFirstMediaUrl('project')) {
                        $img = '<img src="' . asset($data->getFirstMediaUrl('project')) . '" style="width: auto; height: 30px">';
                    } else {
                        $img = '<img src="' . asset('images/no-image.jpg') . '" style="width: auto; height: 30px">';
                    }

                    return $img;
                })
                ->rawColumns(['btn', 'img', 'switches', 'sorting'])
                ->make(true);
        }
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->detail = $request->detail;
        if ($project->save()) {
            $i = 0;
            $medies_original_name = $request->input('image', []);
            foreach ($request->input('image', []) as $file) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))
                    ->withCustomProperties(['order' => $i])
                    ->setName($medies_original_name[$i])
                    ->toMediaCollection('project');
                $i++;
            }

            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('project.index');
        }
        return redirect()->route('project.create');
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
        $data = Project::whereId($id)->first();

        $medias = $data->getMedia('project');
        $images = $medias->sortBy(function ($med, $key) {
            return $med->getCustomProperty('order');
        });


        return view('admin.project.edit', compact('data', 'images'));
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
        $project = Project::whereId($id)->first();
        $project->title = $request->title;
        $project->detail = $request->detail;
        if ($project->save()) {

            $medies = $project->getMedia('project');
            if (count($medies) > 0) {
                foreach ($medies as $media) {
                    if (!in_array($media->file_name, $request->input('image', []))) {
                        $media->delete();
                    }
                }
            }

            $i = 1;
            $medies = $project->getMedia('project')->pluck('file_name')->toArray();
            $medies_original_name = $request->input('image', []);

            foreach ($request->input('image', []) as $file) {
                if (count($medies) === 0 || !in_array($file, $medies)) {
                    $project->addMedia(storage_path('tmp/uploads/' . $file))
                        ->withCustomProperties(['order' => $i])
                        ->setName($medies_original_name[$i - 1])
                        ->toMediaCollection('project');
                } else {
                    $image = $project->getMedia('project')->where('file_name', $file)->first();
                    $image->setCustomProperty('order', $i);
                    $image->save();
                }
                $i++;
            }

            Alert::success('เพิ่มข้อมูลสำเร็จ');
            return redirect()->route('project.index');
        }
        return redirect()->route('project.create');
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
        $page = Project::whereId($id)->first();
        if ($page->delete()) {
            $status = true;
            $message = 'ลบข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function publish($id, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Project::whereId($id)->first();
        $page->publish = $request->data;
        $page->updated_at = Carbon::now();
        if ($page->save()) {
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function sort($id, Request $request)
    {
        $status = false;
        $message = 'ไม่สามารถบันทึกข้อมูลได้';

        $page = Project::whereId($id)->first();
        $page->sort = $request->data;
        $page->updated_at = Carbon::now();
        if ($page->save()) {
            $status = true;
            $message = 'บันทึกข้อมูลเรียบร้อย';
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }

    public function uploadimage(Request $request)
    {
        $path = storage_path('tmp/uploads');
        $imgwidth = 600;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        // $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $name = $file->getClientOriginalName();
        $full_path = storage_path('tmp/uploads/' . $name);
        $img = Image::make($file->getRealPath());
        if ($img->width() > $imgwidth) {
            $img->resize($imgwidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } 

        $img->save($full_path);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function deleteupload(Request $request)
    {
        if (File::exists(storage_path('tmp/uploads/' . $request->name))) {
            File::delete(storage_path('tmp/uploads/' . $request->name));
        } else {

        }
        // return response()->json(['message' => $request->name]);
    }
}
