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

                $arrayValids = [
                    'name'              => 'required|max:80',
                    'slug'              => 'required',
                    'imagem_uploaded'   => 'required',
                ];

                $updateParams = [
                    'name'    => $request->name,
                    'slug'    => $request->slug,
                    'limit' => $request->limit,
                    'limit_tax' => $request->limit_tax,
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'user_id' => $user->id
                ];
            
                if ( $request->imagem_uploaded == 0 )
                {
                    $arrayValids['imagem'] = 'required|mimes:jpeg,bmp,png';
                }

                $validator = Validator::make($request->all(), $arrayValids);

                if ($validator->fails()) {
                    return response()->json(array('fields' => $request->all(),'message' => 'Name, slug, imagem is required'), 400);
                }else{

                    if ( $request->imagem_uploaded == 0 )
                    {
                        if ( $request->has('imagem') ){

                            $fileName = "File".date("_Y-m-d_H_i_s_").".jpg";
                            $path = $request->file('imagem')->move(public_path('/'), $fileName);
                            $photoUrl = url('/'.$fileName);
        
                            $updateParams['imagem'] = $photoUrl;
                        }
                    }

                    $card = Card::updateOrCreate(
                        [
                            'id'    => $request->id
                        ],
                        $updateParams
                    );
            
                    if( $card ){
                        if ( $request->id == 0){
                            return response()->json(['message' => 'Product successfully created!', 'result' => $card], 200);
                        }else{
                            return response()->json(['message' => 'Product successfully updated!', 'result' => $card], 200);
                        }
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
    
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'        => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('fields' => $request->all(),'message' => 'ID is required'), 400);
        }else{
            if (Card::where('id', $request->id)->first()){
                $card = Card::destroy($request->id);
                return response()->json(['message' => 'Product successfully deleted'], 200);
            }
            else return response()->json(['message' => 'Product not exists'], 400);
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

                if ( $request->has('name') ){
                    if ( $request->name != '')
                    {
                        $card = Card::with(['user','brand','category'])
                        ->where('user_id',$user->id)
                        ->where('name', 'like', $request->name.'%')
                        ->orderBy('id','desc')
                        ->paginate(10);
                    }
                }
    
                return response()->json($card, 200);

            }else{
                return response()->json(['erros' => 'user not found'], 400);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json($e->status, 400);
        }
    }
}
