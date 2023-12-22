<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       return view('category.add_category');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cat_name' => 'required|unique:categories|max:255',
        ],
        [
            'cat_name.required' => 'Por favor ingrese el nombre de la categoria',
            'cat_name.max' => 'La categoria no debe tener mas de 255 caracteres',
        ]);

        $data=array();
        $data['cat_name']=$request->cat_name;
        $category=DB::table('categories')->insert($data);
        if($category){
            $notification=array(
                'message'=>'Categoria Insertada Correctamente',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Error al insertar la categoria',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function allcategory()
    {
        $category=DB::table('categories')->get();
        return view('category.all_category',compact('category'));
    }
    public function deletecategory($id)
    {
        $delete=DB::table('categories')->where('id',$id)->delete();
        if($delete){
            $notification=array(
                'message'=>'Categoria Eliminada Correctamente',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'message'=>'Error al eliminar la categoria',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function editcategory($id)
    {
        $category=DB::table('categories')->where('id',$id)->first();
        return view('category.edit_category')->with('cat',$category);
    }

    public function updatecategory(Request $request,$id)
    {

        $data=array();
        $data['cat_name']=$request->cat_name;
        $category=DB::table('categories')->where('id',$id)->update($data);
        if($category){
            $notification=array(
                'message'=>'Categoria Actualizada Correctamente',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.category')->with($notification);
        }else{
            $notification=array(
                'message'=>'Error al actualizar la categoria',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }

    }
}
