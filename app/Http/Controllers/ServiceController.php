<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeviceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getService(){
        $models = Service::all();
      
        if(!empty($_GET)){
            // $name= $_GET['name'];
            $name = isset($_GET['name']) ?$_GET['name'] : '' ;
            $order_by = isset($_GET['order_by']) ?$_GET['order_by'] : '' ;
            $models = Service::where('name', 'LIKE', "%$name%")
         ->orderBy('price', "$order_by")
            ->get();
        }
        return view('services.index', compact('models'));
    }
    public function addForm(){
       
        return view('services.add');
    }
    public function saveAdd (SeviceRequest $request){
       $model= new Service();
       $model->fill($request->all());
       if($request->hasFile('image')){
        $imgPath = $request->file('image')->store('services');
        $imgPath = str_replace('public/', '', $imgPath);
        $model->image = $imgPath;
    }
   
      
      
       $model->save();
       
       return redirect(route('service.index'));
    }
    public function editForm($id){
        $model = Service::find($id);
        
        // var_dump($model);die;
        return view('services.edit',compact('model'));
    }
  
    public function saveEdit(SeviceRequest $request, $id)
    {   
       
        $model =Service::find($id);
        $model->fill($request->all());
        $model->save();
        return redirect(route('service.index'));
    }
}
