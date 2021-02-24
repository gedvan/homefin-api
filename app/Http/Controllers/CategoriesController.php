<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function teste() {

    }

    public function index() {
        $allCategories = Category::all()->toArray();
        $categories = [];
        foreach ($allCategories as $category) {
            if (empty($category['parent_id'])) {
                $categories[$category['id']] = $category;
                $categories[$category['id']]['subcategories'] = [];
            }
        }
        foreach ($allCategories as $category) {
            if ($category['parent_id']) {
                $categories[$category['parent_id']]['subcategories'][] = $category;
            }
        }
        return array_values($categories);
    }

    public function store(Request $request) {
        $category = Category::create($request->all());
        return new JsonResponse($category, 201);
    }

    public function show(Category $category) {
        $categoryArray = $category->toArray();
        $categoryArray['subcategories'] = $category->subcategories->toArray();
        return $categoryArray;
    }

    public function update(Request $request, Category $category) {
        $category->update($request->all());
        return new JsonResponse($category, 200);
    }

    public function delete(Category $category) {
        $category->delete();
        return new JsonResponse(null, 204);
    }

}
