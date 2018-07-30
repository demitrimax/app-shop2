<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::orderBy('name')->paginate(10);
    	return view('admin.categories.index')->with(compact('categories')); //lista los productos
    }
    public function create()
    {
    	return view('admin.categories.create'); //muestra el formulario
    }
    public function store(Request $request)
    {
    	//validar
    	
        $this->validate($request, Category::$rules, Category::$messages);


        //registra la nueva categoria en la bd
    	//dd($request->all());
        Category::create($request->all()); //mass assignment insert

    	return redirect('/admin/categories');    	
    }
    public function edit($id)
    {
    	
        //return "Mostrar aqui el formulario de edición del producto con id $id";
    	$category = Category::find($id);
    	return view('admin.categories.edit')->with(compact('category')); //muestra el formulario de edición
    }
    public function update(Request $request, Category $category )
    {
    	
        $this->validate($request, Category::$rules, Category::$messages);
        //actualiza el producto en la bd
    	//dd($request->all());
        $category->update($request->all());

    	return redirect('/admin/categories');    	
    }

    public function destroy(Request $request, Category $category)
    {
    	//elimina el producto en la bd
    	//dd($request->all());
    	$category->delete(); //DELETE

    	return redirect('/admin/categories');    	
    }
}
