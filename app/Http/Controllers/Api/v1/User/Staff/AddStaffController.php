<?php

namespace App\Http\Controllers\Api\v1\User\Staff;

use App\Events\Auth\CreateAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Staff\AddStaffRequest;
use App\Http\Resources\User\RegisterUserResource;
use App\Models\User\User;
use Illuminate\Database\QueryException;

class AddStaffController extends Controller
{
    public function addStaff(AddStaffRequest $request){
        try {
            $user = User::create([
                "firstName" => $request->firstName,
                "otherNames" => $request->otherNames,
                "email" => $request->email,
                "contact" => $request->contact,
                "password" => bcrypt($request->password),
            ]);
            $user->assignRole($request->role);

            event(new CreateAccount($user));

            return new RegisterUserResource($user);
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not create office or assign it to administrator');
        }
    }
}
