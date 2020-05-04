<?php

namespace App\Http\Controllers\Api\v1\User\Role;

use App\Http\Controllers\Controller;
use App\Models\User\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return (Role::all());
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $role = Role::create([
                'name' => $request->name,
                'gaurd_name' => 'api'
            ]);

            /*
             * @todo Check Bid Resource out....Information breaks.
             * */
            if (role){
                return $role;

                //return new BidResource($bid);
            }

            return response()->json([
                'error' => 'OOPS! Something went wrong saving role. Please try again.'
            ], 500);

        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return Role::find($id);
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            //return 'me';
            $item = Role::find($id);

            if($item){
                //return $item;
                $request = $item->update([
                    'name' => $request->name
                ]);

                if ($request){
                    //return 'mee';
                    return $item;
                }

                return response()->json([
                    'error' => 'OOPS! Something went wrong updating role. Please try again.'
                ], 500);
            }

            return response()->json([
                'error' => 'Role does not exist'
            ], 500);

        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(Role::find($id)->delete()){
                return response()->json([
                    'success' => 'Role has successfully been deleted'
                ]);
            }

            return response()->json([
                'error' => 'OOPS! Something went wrong deleting. Please try again.'
            ], 500);
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }
}
