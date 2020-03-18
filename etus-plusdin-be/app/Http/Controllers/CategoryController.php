<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function findall(Request $request)
    {
        try
        {
            if ( auth()->user() )
            {
                $categories = Category::get();
    
                return response()->json($categories, 200);

            }else{
                return response()->json(['erros' => 'user not found'], 400);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json($e->status, 400);
        }
    }
}
