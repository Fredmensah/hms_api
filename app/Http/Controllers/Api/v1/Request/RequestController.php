<?php

namespace App\Http\Controllers\Api\v1\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\Request\RequestCollection;
use App\Http\Resources\Request\RequestResource;
use App\Models\Request\User_Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\Request\User_Request as RequestValidate;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new RequestCollection(User_Request::all());
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersRequestOne($request_uuid)
    {
        try{
            return new RequestResource(User_Request::where('user_uuid' , Auth::user()->uuid)
                ->where('uuid' , $request_uuid)->first());
        } catch (QueryException $ex){
            abort(500, $ex);
        }catch (\Exception $ex) { // Anything that went wrong
            abort(500, 'Could not perform assignment. Please try again or contact administrator on administrator@udel.com if error persist');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersRequest()
    {
        try{
            return new RequestCollection(User_Request::where('user_uuid' , Auth::user()->uuid)->get());
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
    public function store(RequestValidate $request)
    {
        try{
            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/request'), $imageName);

            $imgPath = public_path('uploads/request');

            $imgPath.= "/{$imageName}";

            $request = User_Request::create([
                'user_uuid' => Auth::user()->uuid,
                'item_size_id' => $request->itemSize,
                'item_category_id' => $request->itemCategory,
                'weight' => $request->weight,
                'weight_unit' => $request->weightUnit,
                'img_path' => $imgPath,
                'description' => $request->description,
                'drop_location' => $request->dropLocation,
                'pickup_location' => $request->pickupLocation,
                'receiver_name' => $request->receiverName,
                'contact_mode' => $request->contactMode,
                'contact_value' => $request->contactValue,
                'delivery_date' => $request->deliveryDate,
            ]);

            if ($request){
                return new RequestResource($request);
            }

            return response()->json([
                'error' => 'OOPS! Something went wrong saving request. Please try again.'
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
    public function show($uuid)
    {
        try{
            return new RequestResource(User_Request::where('uuid' , $uuid)->first());
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
    public function update(RequestValidate $request, $uuid)
    {
        try{
            $item = User_Request::where('uuid' , $uuid)
                ->where('user_uuid' , Auth::user()->uuid)->first();

            if($item){
                $imageName = time().'.'.$request->image->getClientOriginalExtension();

                $request->image->move(public_path('uploads/request'), $imageName);

                $imgPath = public_path('uploads/request');

                $imgPath.= "/{$imageName}";

                $request = User_Request::update([
                    'user_uuid' => Auth::user()->uuid,
                    'item_size_id' => $request->itemSize,
                    'item_category_id' => $request->itemCategory,
                    'weight' => $request->weight,
                    'weight_unit' => $request->weightUnit,
                    'img_path' => $imgPath,
                    'description' => $request->description,
                    'drop_location' => $request->dropLocation,
                    'pickup_location' => $request->pickupLocation,
                    'receiver_name' => $request->receiverName,
                    'contact_mode' => $request->contactMode,
                    'contact_value' => $request->contactValue,
                    'delivery_date' => $request->deliveryDate,
                ]);

                if ($request){
                    return new RequestResource($request);
                }

                return response()->json([
                    'error' => 'OOPS! Something went wrong updating request. Please try again.'
                ], 500);
            }

            return response()->json([
                'error' => 'Request does not exist'
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
    public function destroy($uuid)
    {
        try{
            if((User_Request::where('uuid' , $uuid)
                ->where('user_uuid' , Auth::user()->uuid)->first())->delete()){
                return response()->json([
                    'success' => 'Request has successfully been deleted'
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
