<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class ProductsController extends Controller
{

    use AuthorizesRequests;
    // @desc  Show Product listing
    // @route GET /products
    public function index():View
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

     // @desc  Show Product Form
    // @route GET /products/create
    public function create():View
    {
        // Check if the user is authorized to create a product
        $this->authorize('create', Product::class);
        return view('products.create');
    }

     // @desc  Show Product Form
    // @route POST /products
    public function store(Request $request): RedirectResponse
{
    $validateData = $request->validate([
        'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);

    // Assign Auth user id correctly
    $validateData['user_id'] = auth()->user()->id; 

    // Check for image
    if($request->hasFile('image')){


        //Store file and get path
        $path = $request->file('image')->store('logos','public');

        // send image path to database 
        $validateData['image'] = $path;
    }

    // Submit to database
    Product::create($validateData);

    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}
    

     // @desc  Show Product Detail
    // @route GET /products/{product}
    public function show(Product $product):View
    {
        
        return view('products.show')->with('product',$product);
    }

    // @desc  Show Product Form
    // @route GET /products/{product}/edit
    public function edit(Product $product) :View
    {
        // Check if the user is authorized
        $this->authorize('update', $product);
        return view('products.edit')->with('product',$product);
    }

    // @desc  Show Product Form
    // @route PUT /products/{product}
    public function update(Request $request, Product $product):RedirectResponse
    {

        // Check if the user is authorized
        $this->authorize('update', $product);

        $validateData = $request->validate([
            'image'=>'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price' => 'required|numeric|min:0',
              
        ]);


        // Check for image
        if($request->hasFile('image')){

            //Delete old logo
            Storage::delete('public/logos/' . basename($product->image));

            //Store file and get path
            $path = $request->file('image')->store('logos','public');

            // send image path to database 
            $validateData['image'] = $path;
        }

        //Submit to database
        $product->update($validateData);

        return redirect()->route('products.index')->with('success','Job listing created successfully!');
    }

    // @desc  Delete a Product
    // @route DELETE /products/{product}
    public function destroy(Product $product) :RedirectResponse
    {

        // Check if the user is authorized
        $this->authorize('delete', $product);

        //if logo then delete it 
        // if($job->company_logo){
        //     Storage::delete('public/logos/' . $job->company_logo);
        // }
        $product->delete();
        return redirect()->route('products.index')->with('success','Job listing deleted successfully!');
    }

    public function cart():View{
        return view('products.cart');
    }

     // @desc  Add to cart a Product
    // @route DELETE /add-to-cart/{product}
    public function addToCart($id)
    {

        $product = Product::find($id);
        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'name'=>$product->name,
                'quantity'=>1,
                'price'=>$product->price
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Product added to cart successfully!');
    }

    public function remove(Request $request){
        if($request->id){
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }
            session()->flash('success','Product removed successfully!');
        }   
    }
}
