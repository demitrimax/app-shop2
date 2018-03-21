<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    //
    public function store(Request $request) 
    {
    	

    	$cartDetail = new CartDetail();
    	$cartDetail->cart_id = auth()->user()->cart->id;
    	$cartDetail->product_id = $request->product_id;
    	$cartDetail->quantity = $request->quantity;
    	$cartDetail->save();
        if ($cartDetail)
            $notificacion = "Se ha agregado el producto al carrito de compras";

    	return back()->with(compact('notificacion'));
    }

    public function destroy(Request $request) 
    {
        $cartDetail = CartDetail::find($request->cart_detail_id);
        if ($cartDetail->cart_id == auth()->user()->cart->id) {
            $cartDetail->delete();
            $notificacion = "El producto se ha eliminado del carrito de compras";
        }
        else
        {
            $notificacion = "Hubo un problema al realizar esta petición";
        }

        return back()->with(compact('notificacion'));
    }
}
