<?php

namespace App\Http\Controllers;

use App\Product;
use App\Material;
use App\Category;
use Auth;
use Storage;
use File;
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
		$products = Product::paginate(20);
		return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category::where('status', '=', 1)->get();
		$materials = Material::where('status', '=', 1)->get();
        return view('admin.products.create', compact('materials', 'categories'));
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
			'category' => 'required',
			'material' => 'required',
			'description' => 'required',
			'price' => 'required|numeric',
			'images' => 'required',
 			'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
		]);

		$product = new Product();
		$product->name = $request->name;
		$product->category_id = $request->category;
		$product->material_id = $request->material;
		$product->description = $request->description;
		$product->price = $request->price;

		if($request->hasFile('images'))
		{
			$category_folder = Category::find($request->category);

			$image_names = array();
			$image_mimes = array();
			$orignal_image_names = array();

			foreach($request->images as $image)
			{
				$extension = $image->getClientOriginalExtension();
				array_push($image_names, $image->getFilename().'.'.$extension);
				array_push($image_mimes, $image->getClientMimeType());
				array_push($orignal_image_names, $image->getClientOriginalName());
				Storage::disk('public')->put($category_folder->name.'/'.$image->getFilename().'.'.$extension, File::get($image));
			}

			$product->image_names = implode(',', $image_names);
			$product->image_mimes = implode(',', $image_mimes);
			$product->original_image_names = implode(',', $orignal_image_names);

		}

		$product->created_by = Auth::user()->id;
		$product->updated_by = Auth::user()->id;

		//dd($product);
		$product->save();

		\Session::flash('success', 'Product created successfully!');
		return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$product = Product::find($id);

		if(!$product)
		{
			\Session::flash('danger', 'No product found having the id: '. $id.'!');
			return redirect('/admin/products');
		}

		$images = explode(',', $product->image_names);
		$original_image_names = explode(',', $product->original_image_names);

		return view('admin.products.view', compact('product', 'images', 'original_image_names'));
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

		if(!$product)
		{
			\Session::flash('danger', 'No product found having the id: '. $id.'!');
			return redirect('/admin/products');
		}
		$images = explode(',', $product->image_names);
		$original_image_names = explode(',', $product->original_image_names);

		$categories = Category::where('status', '=', 1)->get();
		$materials = Material::where('status', '=', 1)->get();

		return view('admin.products.edit', compact('product', 'categories', 'materials', 'images', 'original_image_names'));
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
        $product = Product::find($id);

		if(!$product)
		{
			\Session::flash('danger', 'No product found having the id: '. $id.'!');
			return redirect('/admin/products');
		}

		$this->validate($request, [
			'name' => 'required',
			'category' => 'required',
			'material' => 'required',
			'description' => 'required',
			'price' => 'required|numeric',
		]);

		$product->name = $request->name;
		$product->category_id = $request->category;
		$product->material_id = $request->material;
		$product->description = $request->description;
		$product->price = $request->price;
		$product->status = $request->status == 'on' ? 1 : 0;
		$product->updated_by = Auth::user()->id;

		if($request->upload_images == 'add' || $request->upload_images == 'delete')
		{
			$this->validate($request, [
				'images' => 'required',
 				'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
			]);
			$category_folder = Category::find($request->category);

			$image_names = array();
			$image_mimes = array();
			$original_image_names = array();

			$old_category_folder_name = $product->category->name;

			if($request->upload_images == 'delete')
			{
				$old_image_names = explode(',', $product->image_names);
				for($i=0; $i<count($old_image_names); $i++)
				{
					Storage::disk('public')->delete($old_category_folder_name.'/'.$old_image_names[$i]);
				}
				foreach($request->images as $image)
				{
					$extension = $image->getClientOriginalExtension();
					array_push($image_names, $image->getFilename().'.'.$extension);
					array_push($image_mimes, $image->getClientMimeType());
					array_push($original_image_names, $image->getClientOriginalName());
					Storage::disk('public')->put($category_folder->name.'/'.$image->getFilename().'.'.$extension, File::get($image));
				}
			}
			else
			{
				$image_names = explode(',', $product->image_names);
				$image_mimes = explode(',', $product->image_mimes);
				$original_image_names = explode(',', $product->original_image_names);
				foreach($request->images as $image)
				{
					$extension = $image->getClientOriginalExtension();
					array_push($image_names, $image->getFilename().'.'.$extension);
					array_push($image_mimes, $image->getClientMimeType());
					array_push($original_image_names, $image->getClientOriginalName());
					Storage::disk('public')->put($old_category_folder_name.'/'.$image->getFileName().'.'.$extension,  File::get($image));
				}
			}
			$product->image_names = implode(',', $image_names);
			$product->image_mimes = implode(',', $image_mimes);
			$product->original_image_names = implode(',', $original_image_names);
		}

		$product->save();

		\Session::flash('success', 'Product: '.$product->name.' updated successfully!');
		return redirect('/admin/products');
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

		if(!$product)
		{
			\Session::flash('danger', 'No product found having the id: '. $id.'!');
			return redirect('/admin/products');
		}

		$product->status = 0;
		$product->updated_by = Auth::user()->id;

		$product->save();
		\Session::flash('warning', 'Poduct: '.$product->name.' deleted successfully!');
		return redirect('/admin/products');
    }
}
