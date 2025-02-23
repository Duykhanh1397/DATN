<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Lấy danh sách sản phẩm với thông tin liên quan
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->join('product_variants', 'products.product_id', '=', 'product_variants.product_id')
            ->join('variant_values', 'product_variants.variant_id', '=', 'variant_values.variant_id')
            ->select(
                'products.name as product_name',
                'categories.name as category_name',
                'products.description',
                'products.status',
                'variant_values.stock',
                'variant_values.price',
                'variant_values.color_name',
                'variant_values.storage_size'
            )
            ->get();

        return response()->json($products);
    }

    // Thêm sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $product = Product::create($request->all());

        return response()->json(['message' => 'Sản phẩm được tạo thành công!', 'product' => $product], 201);
    }

    //  Lấy thông tin chi tiết sản phẩm
    public function show($id)
    {
        $product = Product::with(['category', 'variants.values'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm!'], 404);
        }

        return response()->json($product);
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm!'], 404);
        }

        $product->update($request->all());

        return response()->json(['message' => 'Cập nhật thành công!', 'product' => $product]);
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm!'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Xóa sản phẩm thành công!']);
    }
}
