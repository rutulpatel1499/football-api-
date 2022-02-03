<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\team;
use App\Models\club;
use App\Models\players;
use Log;
use Illuminate\Support\Facades\Validator;
class NewController extends Controller
{
    //
    
    public function createteam(Request $req)
    {
    try
    {
        $rules=[
            "user_id"=>"required",
            "club_id"=>"required",
            "name"=>"required"
        ];
        $messages = [
            'user_id.required' => 'user_id is Required.',
            'club_id.required' => 'club_id is Required.',
            'name' => 'name is Required.',
           
        ];
        $validator=Validator::make($req->json()->all(),$rules,$messages);
        // return $validator->errors();
        if($validator->fails())
        {
            return response()->json(['validation' =>'error', 'validationerror' =>$validator->errors()],422);
        }
        else
        {
            // echo("yes");
            $users = club::all();
            // print_r($users);
            foreach($users as $user)
            {
                if ($user['id'] == $req['club_id'])
                {
                    // echo"yes";
                    $user = new team;
                    $user->user_id=$req->user_id;
                    $user->club_id=$req->club_id;
                    $user->name=$req->name;
                    $result=$user->save();        
                }
            }
            if($result)
            {
                return response()->json(['message' => 'data save', 'data' =>$req->json()->all()],200);
            }
            else{
                return response()->json(['message' => 'internal server error', 'data' => $req->json()->all()],500);
            }
        }
    }
    catch (\Exception $e) 
    {

        Log::info('message:'.$e->getMessage());
        Log::info('code:'.$e->getCode());
        return response()->json(['message' => 'internal server error'],500);
    }
    }
    public function index()
    {
        $user=team::get();
        if($user)
        {
            return response()->json(['status' => true, 'data' => $user],200);
        }
        else{
            return response()->json(['status' => false,'message'=>'Data Not Found'],400);
        }

    }
    public function addplayer(Request $req)
    {
        try
        {
            $rules=[
                "user_id"=>"required",
                "team_id"=>"required",
                "club_id"=>"required",
                "name"=>"required"
            ];
            $messages = [
                'user_id.required' => 'user_id is Required.',
                'team_id.required' => 'team_id is Required.',
                'club_id.required' => 'club_id is Required.',
                'name' => 'name is Required.',
            
            ];
            $validator=Validator::make($req->json()->all(),$rules,$messages);
            // return $validator->errors();
            if($validator->fails())
            {
                return response()->json(['validation' =>'error', 'validationerror' =>$validator->errors()],422);
                // return $validator->error();
            }
            else
            {
                $users = club::all();
                foreach($users as $user)
                {
                    if ($user['id'] == $req['club_id'])
                    {
                        $user = new players;
                        $user->user_id=$req->user_id;
                        $user->team_id=$req->team_id;
                        $user->club_id=$req->club_id;
                        $user->name=$req->name;
                        $result=$user->save();       
                    }
                }
                if($result)
                {
                    return response()->json(['message' => 'data save', 'data' =>$req->json()->all()],200);
                }
                else{
                    return response()->json(['message' => 'internal server error'],500);
                }
            }
        }
        catch (\Exception $e) 
        {

            Log::info('message:'.$e->getMessage());
            Log::info('code:'.$e->getCode());
            return response()->json(['message' => 'internal server error'],500);
        }
    }
    public function viewplayer()
    {
       
        $user=players::get();
        $usercount = count($user);
        if($user)
        {
            return response()->json(['status' => true,'count'=>$usercount ,'data' => $user],200);
        }
        else{
            return response()->json(['status' => false,'message'=>'Data Not Found'],400);
        }

    }
    public function club(Request $req)
    {
        try
        {
            $rules=[
                "user_id"=>"required",
                "name"=>"required",
                "location"=>"required",
            ];
            $messages = [
                'user_id.required' => 'user_id is Required.',
                'name' => 'name is Required.',
                'location' => 'name is Required.',
            
            ];
            $validator=Validator::make($req->json()->all(),$rules,$messages);
            // return $validator->errors();
            if($validator->fails())
            {
                return response()->json(['validation' =>'error', 'validationerror' =>$validator->errors()],422);
                }
            else
            {
                $user = new club;
                $user->user_id=$req->user_id;
                $user->name=$req->name;
                $user->location=$req->location;
                $result=$user->save();
                if($result)
                {
                    return response()->json(['message' => 'data save', 'data' =>$req->json()->all()],200);
                }
                else{
                    return response()->json(['message' => 'internal server error'],500);
                }
            }
        }
        catch (\Exception $e) 
        {

            Log::info('message:'.$e->getMessage());
            Log::info('code:'.$e->getCode());
            return response()->json(['message' => 'internal server error'],500);
        }
    }
    public function viewclub($id)
    {
        $user=club::find($id);
        if($user)
        {
            return response()->json(["message"=>"data view","data"=>$user],200);
        }
        else
        {
            return response()->json(["message"=>"data not found"],400);
        }
    }
    public function delete($id)
    {
        try
        {
            $user= club::find($id);
            $result=$user->delete();
            if($result)
            {
                return response()->json(['result'=>'record has been deleted','data'=>$user],200);
            }
            else
            {
                return response()->json(['result'=>'internal server error'],500);

            }
        }
        catch (\Exception $e) 
        {

            Log::info('message:'.$e->getMessage());
            Log::info('code:'.$e->getCode());
            return response()->json(['message' => 'internal server error'],500);
        }
    }
    public function updateclub(Request $req)
    {
        try
        {
            $user = club::find($req->id);
            $user->user_id=$req->user_id;
            $user->name=$req->name;
            $user->location=$req->location;
            $result=$user->save();
            if($result)
            {
                return response()->json(['message' => 'data save', 'data' =>$req->json()->all()],200);
            }
            else{
                return response()->json(['message' => 'internal server error'],500);
            }
        }  
        catch (\Exception $e) 
        {

            Log::info('message:'.$e->getMessage());
            Log::info('code:'.$e->getCode());
            return response()->json(['message' => 'internal server error'],500);
        }
    }
    
}
