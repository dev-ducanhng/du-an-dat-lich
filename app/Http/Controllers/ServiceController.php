<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeviceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function getService()
    {
        $models = Service::all();

        if (!empty($_GET)) {
            // $name= $_GET['name'];
            $name = isset($_GET['name']) ? $_GET['name'] : '';
            $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'asc';
            $models = Service::where('name', 'LIKE', "%$name%")
                ->orderBy('price', "$order_by")
                ->get();
        }
        // $users = $query->paginate(10)->withQueryString();
        return view('service.index', compact('models'));
    }
    public function addForm()
    {

        return view('service.add');
    }
    public function saveAdd(SeviceRequest $request)
    {

        $model = new Service();
        $model->fill($request->all());
        if ($request->hasFile('image')) {
            $imgPath = $request->file('image')->store('services');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->image = $imgPath;
        }


        // dd($model);
        $model->save();

        return redirect(route('service.index'));
    }
    public function editForm($id)
    {

        $model = Service::find($id);
        if (!$model) {
            return back();
        }
        // var_dump($model);die;
        return view('service.edit', compact('model'));
    }

    public function saveEdit(SeviceRequest $request, $id)
    {

        $model = Service::find($id);

        $model->fill($request->all());
        if ($request->hasFile('image')) {
            Storage::delete($model->image);

            $imgPath = $request->file('image')->store('services');
            $imgPath = str_replace('public/', '', $imgPath);
            $model->image = $imgPath;
        }
        $model->save();
        return redirect(route('service.index'));
    }
}
