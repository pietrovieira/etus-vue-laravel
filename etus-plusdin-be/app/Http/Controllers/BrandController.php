<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    //
    public function findall(Request $request)
    {
        try
        {
            if ( auth()->user() )
            {
                $brands = Brand::get();
    
                return response()->json($brands, 200);

            }else{
                return response()->json(['erros' => 'user not found'], 400);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json($e->status, 400);
        }
    }
}
