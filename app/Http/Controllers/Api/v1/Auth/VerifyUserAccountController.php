<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\VerifyUserAccountRequest;
use App\Http\Resources\User\RegisterUserResource;
use App\Models\User\User;
use App\Models\User\VerifyAccountToken;
use GuzzleHttp\Client;

class VerifyUserAccountController extends Controller
{
    public function verifyAccount(VerifyUserAccountRequest $request)
    {
        //return 'me';
        try{

            $token = VerifyAccountToken::where('user_uuid' , $request->userId)
                ->where('token' , $request->token)->orderBy('created_at' , 'desc')->first();

            //return $token;
            if($token){
                $user = User::find($token->user->id);
                //return $user;
                $user->status = 'active';

                if($user->save()){
                    /*
                     * @todo
                     * try doing force login here...
                     * */
                    /*$verifiedUser = new Client();

                    $response = $verifiedUser->post('http://127.0.0.1:8070/oauth/token', [
                        'form_params' => [
                            'grant_type' => 'password',
                            'client_id' => $request->client_id,
                            'client_secret' => $request->secret,
                            'username' => $user->email,
                            'password' => $request->password,
                            'scope' => '',
                        ],
                    ]);

                    return json_decode((string) $response, true);*/

                    return new RegisterUserResource($user);
                }

                return response()->json([
                    'error' => 'User could not be verified'
                ] , 400);
            }

            return response()->json([
                'error' => 'Wrong token'
            ] , 400);

        } catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }
}
