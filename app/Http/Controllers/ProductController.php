<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private function __getQuery($request)
    {
        $keyword = $request->has('keyword') ? $request->keyword : null;
        $selected_price = $request->has('price') ? $request->price : null;
        $selected_category = $request->has('category') ? $request->category : null;
        $selected_tags = $request->has('tags') ? $request->tags : [];

        $query = Product::with(['tags', 'category']);

        if ($keyword) {
            $query = $query->where('name', 'like', "%$keyword%");
//            $query = $query->search($keyword);
        }

        if ($selected_price) {
            $query = $query->when($selected_price, function ($query) use ($selected_price) {
                switch ($selected_price) {
                    case "price_0_500":
                        $query->whereBetween('price', [0, 500]);
                        break;
                    case "price_501_1500":
                        $query->whereBetween('price', [501, 1500]);
                        break;
                    case "price_1501_3000":
                        $query->whereBetween('price', [1501, 3000]);
                        break;
                    case "price_3001_5000":
                        $query->whereBetween('price', [3001, 5000]);
                        break;
                }
            });
        }

        if ($selected_category) {
            $query = $query->whereCategoryId($selected_category);
        }

        if (is_array($selected_tags) && count($selected_tags) > 0) {
            $query = $query->whereHas('tags', function ($query) use ($selected_tags) {
                $query->whereIn('product_tag.tag_id', $selected_tags);
            });
        }

        return $query;
    }


    public function index(Request $request)
    {
        $keyword = $request->has('keyword') ? $request->keyword : null;
        $selected_price = $request->has('price') ? $request->price : null;
        $selected_category = $request->has('category') ? $request->category : null;
        $selected_tags = $request->has('tags') ? $request->tags : [];

        $query = $this->__getQuery($request);
        $products = $query->orderByDesc('id')->paginate(10);

        $tags = Tag::pluck('name', 'id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view(
            'products.index',
            compact(
                [
                    'tags',
                    'products',
                    'categories',
                    'keyword',
                    'selected_price',
                    'selected_category',
                    'selected_tags'
                ]
            )
        );
    }

    public function list(Request $request)
    {
        $keyword = $request->has('keyword') ? $request->keyword : null;
        $selected_price = $request->has('price') ? $request->price : null;
        $selected_category = $request->has('category') ? $request->category : null;
        $selected_tags = $request->has('tags') ? $request->tags : [];

        $query = $this->__getQuery($request);
        $products = $query->orderByDesc('id')->paginate(20);

        $tags = Tag::pluck('name', 'id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view(
            'products.list',
            compact(
                [
                    'tags',
                    'products',
                    'categories',
                    'keyword',
                    'selected_price',
                    'selected_category',
                    'selected_tags'
                ]
            )
        );
    }

    public function create()
    {
        $tags = Tag::pluck('name', 'id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view('products.create', compact(['tags', 'categories']));
    }

    public function store(StoreProductRequest $request)
    {
        //create product
        $product = Product::create(
            $request->safe()->except(['tags']) + [
                'image' => "https://via.placeholder.com/150/?Text=$request->name"
            ]
        );

        //attach tags to the product
        $product->tags()->attach($request->tags);

        return redirect()->back();
    }

    public function edit(Request $request, Product $product)
    {
        $selected_tags = $product->tags()->pluck('id')->toArray();
        $tags = Tag::pluck('name','id')->toArray();
        $categories = Category::pluck('name', 'id')->toArray();
        return view('products.edit', compact(['tags', 'product','categories','selected_tags']));
    }

    public function update(StoreProductRequest $request,Product $product)
    {
        //update product
        $product->update(
            $request->safe()->except(['tags']) + [
                'image' => "https://via.placeholder.com/150/?Text=$request->name"
            ]
        );

        //attach tags to the product
        $product->tags()->sync($request->tags);

        return redirect()->route('products.list');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }


}
