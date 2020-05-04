<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $user = \App\Models\User\User::create([
                "firstName" => "Joshua",
                "otherNames" => "Odoi",
                "email" => "odoijoshua55@gmail.com",
                "contact" => "0241059900",
                "password" => bcrypt("secret"),
            ]);
            $user->assignRole('SuperAdmin');

            event(new \App\Events\Auth\CreateAccount($user));

            /*$token = \App\Models\User\VerifyAccountToken::where('user_uuid' , $user->uuid)
                ->where('token' , (array_values(array_slice($user->otp, -1))[0])->token)->orderBy('created_at' , 'desc')->first();*/

            //return $token;
            if($user){
                $user = \App\Models\User\User::find($user->id);
                //return $user;
                $user->status = 'active';
                $user->idVerified = 1;
                if($user->save()) {
                }
            }
        } catch (\Illuminate\Database\QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not create office or assign it to administrator');
        }
    }
}
