<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductController extends Controller
{
    //
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); //lista los productos
    }
    public function create()
    {
    	$categories = Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories')); //muestra el formulario
    }
    public function store(Request $request)
    {
    	$messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe contener almenos 3 caracteres',
            'description.required' => 'Es necesario la descripción del producto',
            'description.max' => 'La descripción corta solo admite 200 caracteres',
            'price.required' => 'Es necesario ingresar el precio del producto',
            'price.numeric' => 'El precio debe ser numerico',
            'price.min' => 'No se admiten valores negativos'

        ];
        //validar los datos
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);


        //registra el nuevo producto en la bd
    	//dd($request->all());
    	$product = new Product();
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->input('category_id');
    	$product->save(); //INSERT

    	return redirect('/admin/products');    	
    }
    public function edit($id)
    {
    	
        //return "Mostrar aqui el formulario de edición del producto con id $id";
    	$product = Product::find($id);
        $categories = Category::orderBy('name')->get();
    	return view('admin.products.edit')->with(compact('product', 'categories')); //muestra el formulario de edición
    }
    public function update(Request $request, $id)
    {
    	$messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe contener almenos 3 caracteres',
            'description.required' => 'Es necesario la descripción del producto',
            'description.max' => 'La descripción corta solo admite 200 caracteres',
            'price.required' => 'Es necesario ingresar el precio del producto',
            'price.numeric' => 'El precio debe ser numerico',
            'price.min' => 'No se admiten valores negativos'

        ];
        //validar los datos
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        //actualiza el producto en la bd
    	//dd($request->all());
    	$product = Product::find($id);
    	$product->name = $request->input('name');
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->input('category_id');
    	$product->save(); //UPDATE

    	return redirect('/admin/products');    	
    }

    public function destroy(Request $request, $id)
    {
    	//elimina el producto en la bd
    	//dd($request->all());

    	ProductImage::where('product_id', $id)->delete();

    	$product = Product::find($id);
    	$product->delete(); //DELETE

    	return redirect('/admin/products');    	
    }

}
