<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Member;
use App\Models\Organization;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAboutUs(Request $request)
    {
        // Jika ada parameter 'slug'
        if ($request->has('slug')) {
            $slugs = $request->slug;

            // Jika slug dikirim sebagai array
            if (is_array($slugs)) {
                $aboutUs = AboutUs::whereIn('slug', $slugs)->get();
            } else {
                // Jika slug tunggal
                $aboutUs = AboutUs::where('slug', $slugs)->get();
            }

            if ($aboutUs->isNotEmpty()) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Data ditemukan',
                    'data' => $aboutUs
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        // Jika tidak ada slug, kembalikan semua data
        $aboutUs = AboutUs::all();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Semua data ditemukan',
            'data' => $aboutUs
        ]);
    }


    public function getMember(Request $request)
    {
        $member = Member::all();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $member
        ]);
    }

    public function getOrganization(Request $request)
    {
        $organization = Organization::all();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $organization
        ]);
    }

    public function getProduct(Request $request)
    {
        // Jika request punya parameter 'id'
        if ($request->has('id')) {
            $product = Product::with('category')->where('id', $request->id)->first();

            if ($product) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Data ditemukan',
                    'data' => $product
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        // Query dasar
        $query = Product::with('category');

        // Jika ada parameter 'limit'
        if ($request->has('limit')) {
            $limit = (int) $request->limit;
            $query->limit($limit);
        }

        $products = $query->get();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $products
        ]);
    }


    public function getCategory(Request $request)
    {
        // Hanya mengambil kategori yang memiliki produk
        $category = ProductCategory::has('products')->get();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $category
        ]);
    }

    public function getService(Request $request)
    {
        $service = Service::all();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $service
        ]);
    }
}
