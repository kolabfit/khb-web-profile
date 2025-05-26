<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Member;
use App\Models\ProductCategory;
use App\Models\Service;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAboutUs(Request $request)
    {
        $aboutUs = AboutUs::all();

        if ($request->has('slug')) {
            $aboutUs = AboutUs::where('slug', $request->slug)->first();
            if ($aboutUs) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Data ditemukan',
                    'data' => $aboutUs->toArray()
                ]);
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Data ditemukan',
                'data' => $aboutUs
            ]);
        }
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
        $organization = AboutUs::all();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $organization
        ]);
    }

    public function getProduct(Request $request)
    {
        $product = AboutUs::all();

        if ($request->has('id')) {
            $product = AboutUs::where('id', $request->id)->first();
            if ($product) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'Data ditemukan',
                    'data' => $product->toArray()
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 404,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Data ditemukan',
                'data' => $product
            ]);
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Data ditemukan',
            'data' => $product
        ]);
    }

    public function getCategory(Request $request)
    {
        $category = ProductCategory::with('products')->get();

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
