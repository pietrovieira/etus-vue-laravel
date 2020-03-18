<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use Validator;

class CardController extends Controller
{
    public function update(Request $request)
    {
        try
        {
            if ( auth()->user() )
            {
                $user = auth()->user();

                $validator = Validator::make($request->all(), [
                    'name'      => 'required|max:80',
                    'slug'      => 'required',
                    'imagem'    => 'required|mimes:jpeg,bmp,png'
                ]);
        
                // return response()->json($request->all(), 400);

                if ($validator->fails()) {
                    return response()->json(array('fields' => $request->all(),'message' => 'Name, slug, imagem is required'), 400);
                }else{

                    $fileName = "File".date("_Y-m-d_H_i_s_").".jpg";
                    $path = $request->file('imagem')->move(public_path('/'), $fileName);
                    $photoUrl = url('/'.$fileName);

                    $card = Card::updateOrCreate(
                        [
                            'id'    => $request->id
                        ],
                        [
                            'name'    => $request->name,
                            'slug'    => $request->slug,
                            'imagem' => $photoUrl,
                            'limit' => $request->limit,
                            'limit_tax' => $request->limit_tax,
                            'brand_id' => $request->brand_id,
                            'category_id' => $request->category_id,
                            'user_id' => $user->id
                        ]
                    );
            
                    if( $card ){
                        return response()->json(['message' => 'Product successfully created!', 'result' => $card], 201);
                    }
                }

            }else{
                return response()->json(['erros' => 'user not found'], 400);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json($e, 400);
        }
        catch(\Exception $e)
        {
            return response()->json($e, 400);
        } 
    }
    
    public function all(Request $request)
    {
        $card = Card::with(['user','brand','category'])
        ->orderBy('id','desc')
        ->paginate(10);

        return response()->json($card, 200);
    }
    
    public function findall(Request $request)
    {
        try
        {
            if ( auth()->user() )
            {
                $user = auth()->user();
    
                $card = Card::with(['user','brand','category'])
                ->where('user_id',$user->id)
                ->orderBy('id','desc')
                ->paginate(10);
    
                return response()->json($card, 200);

            }else{
                return response()->json(['erros' => 'user not found'], 400);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json($e->status, 400);
        }
    }
}
