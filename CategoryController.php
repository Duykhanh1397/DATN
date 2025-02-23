<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Lấy danh sách danh mục
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Tạo danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $category = Category::create($request->all());

        return response()->json(['message' => 'Danh mục được tạo thành công!', 'category' => $category], 201);
    }

    // Xem chi tiết danh mục
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
        }

        return response()->json($category);
    }

    // Cập nhật danh mục
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
        }

        $category->update($request->all());

        return response()->json(['message' => 'Cập nhật thành công!', 'category' => $category]);
    }

    //  Xóa danh mục
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục!'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Xóa danh mục thành công!']);
    }
}
