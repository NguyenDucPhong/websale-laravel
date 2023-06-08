<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\ProductDetail;
use App\Models\ProductComment;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function show($id){
        $product = Product::findOrFail($id);
        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if ($countRating != null) {
            $avgRating = $sumRating/$countRating;
        }

        $relatedProducts = Product::where('product_category_id', $product->product_category_id)->where('tag', $product->tag)->limit(4)->get();
        
      
        return view('front.shop.show', compact('product', 'avgRating', 'relatedProducts'));
    }

    public function postComment(Request $request){
        ProductComment::create($request->all());

        return redirect()->back();
    }

    public function index(Request $request){
        
        $categories = ProductCategory::all();
        $brands = Brand::all();

        $perPage = $request->show ?? 9;
        $sortBy = $request->sort_by ?? 'latest';
        $search = $request->search ?? '';
       
        $products = Product::where('name', 'like','%'.$search.'%');
        $products = $this->filter($products, $request);
        $products= $this->sort($products, $sortBy, $perPage);


        return view('front.shop.index', compact( 'categories', 'brands', 'products'));
    }

    public function category($categoryName, Request $request){
        $categories = ProductCategory::all();
        $brands = Brand::all();

        $perPage = $request->show ?? 3;
        $sortBy = $request->sort_by ?? 'latest';
        $products = ProductCategory::where('name', $categoryName)->first()->products->toQuery();
       
        $products = $this->filter($products, $request);
        $products= $this->sort($products, $sortBy, $perPage);
        
        return view('front.shop.index', compact( 'categories', 'brands','products' ));
       
    }

    public function sort($products, $sortBy, $perPage ){
        switch($sortBy){
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products =  $products->orderByDesc('id');
                break;
            case 'name-ascending':
                $products =  $products->orderBy('name');
                break;
            case 'name-descending':
                $products =  $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products =  $products->orderBy('price');
                break;
            case 'price-descending':
                $products =  $products->orderByDesc('price');
                break;
            default:
                $products =  $products->orderBy('id');
                break;
        }
        $products = $products->paginate($perPage);

        return $products;
    }

    public function filter($products, Request $request)
    {
        // Brand
        $brands = $request->brand ?? [];

        $brand_ids = array_keys($brands);
     
        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

        // Price
        $priceMax = $request->price_max;
        $priceMin = $request->price_min;
        $priceMax = str_replace('$','',$priceMax);
        $priceMin = str_replace('$','',$priceMin);

        $products = ($priceMax != null && $priceMin != null) ? $products->whereBetween('price', [$priceMin, $priceMax]) : $products;

        //Color
        // $color = $request->color;
        
        // $products = $color != null
        //  ? $products->whereHas('productDetails', function($query) use($color) {
        //     return $query->where('qty','>',0);
        // })
        //  : $products;
      
        //size
        $size = $request->size;
        $products = $size != null ? $products->whereHas('productDetails', function($query) use($size) { 
            return $query->where('size', $size)->where('qty','>',0);
        }) : $products;

       

        return $products;
    }
}
