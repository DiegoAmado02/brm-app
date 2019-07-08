<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use function Sodium\compare;

class ProductsController extends Controller
{
    public function indexprod(){
        $products = Products::orderBy('id', 'ASC')
            ->paginate(10);

        return view('provider.product', compact('products'));
    }

    public function clientprod(){
        $products = Products::orderBy('id', 'ASC')
            ->paginate(10);

        return view('client.product', compact('products'));
    }

    public function createprod(){
        return view('provider.created');
    }

    public function storeprod(){
        $data = request()->validate([
            'product' => '',
            'lote' => '',
            'quantity' => '',
            'expiration_date' => '',
            'price' => ''
        ]);

        Products::create([
            'product' => $data['product'],
            'lote' => $data['lote'],
            'quantity' => $data['quantity'],
            'expiration_date' => $data['expiration_date'],
            'price' => $data['price'],
            'is_active' => true
        ]);

        return redirect()->route('provider.products');
    }

    public function editprod(){
        $products = Products::orderBy('id', 'ASC')
            ->where('quantity', '<>','0')->get();

        return view('client.buy', compact('products'));
    }

    public function ajaxRequest()
    {
        $products = Products::orderBy('id', 'ASC')
            ->where('quantity', '<>','0')->get();

        return view('client.buy', compact('products'));
    }

    public function ajaxRequestPost(Request $request)
    {
        $data = $request->all();
        if ($request->ajax()){
            $idProducto=$request->input('product_id');
            $producto = Products::where('id','=',$idProducto)->get();
            return response()->json([$producto]);
        }
    }

    public function ajaxRequestCount()
    {
        $products = Products::orderBy('id', 'ASC')->get();

        return view('client.buy', compact('products'));
    }

    public function ajaxRequestPostCount(Request $request)
    {
        $data = $request->all();
        if ($request->ajax()){
            $idProducto=$request->input('product_id');
            $cantidad = Products::where('id','=',$idProducto)
                ->select('quantity')->get();
            return response()->json([$cantidad]);
        }
    }

    public function update()
    {
        $id=request()->input('product');
        $cantidad = request()->input('quantity');
        $quantity = Products::find($id);
        if ($cantidad > $quantity){
            $result = $cantidad-$quantity->quantity;
        }else{
            $result = $quantity->quantity-$cantidad;
        }
        $quantity->update(['quantity' => $result]);

        $producto = $quantity->product;
        $precio = $quantity->price;
        return view('client.invoice',compact('producto','precio','cantidad'));

    }
}
