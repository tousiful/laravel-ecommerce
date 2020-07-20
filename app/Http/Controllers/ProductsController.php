<?php

namespace App\Http\Controllers;
use App\Product;
use Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
 
      $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'description' => 'required'
        ]);

       $image = $request->image;

       $new_image =time().$image->getClientOriginalName();
  
       $image->move('uploads/products/', $new_image);
    
       Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'uploads/products/'.$new_image,
            'description' => $request->description,
       ]);

       Session::flash('success', 'Product created successfully');
       return redirect()->back();
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
        $product = Product::find($id);

        return view( 'products.edit', ['product' => $product] );
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
         $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

         $product = Product::find($id);

        if(file_exists($request->image)){
           $image = $request->image;

           $new_image =time().$image->getClientOriginalName();
      
           $image->move('uploads/products/', $new_image);
           $product->image = 'uploads/products/'.$new_image;
        }
     
     $product->name= $request->name;
     $product->price = $request->price;
     $product->description =$request->description;


    $product-> save();

       Session::flash('success', 'Product updated successfully');
       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(file_exists($product->image)){
            unlink($product->image);
        }
        $product->delete();
        Session::flash('success', 'Product deleted successfully');
         return redirect()->back();
    }
}
