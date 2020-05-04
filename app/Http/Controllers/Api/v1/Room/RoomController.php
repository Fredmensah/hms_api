<?php

namespace App\Http\Controllers\Api\v1\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Http\Resources\Room\RoomCollection;
use App\Http\Resources\Room\RoomResorce;
use App\Models\Room\Room;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new RoomCollection(Room::all());
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
    public function store(RoomRequest $request)
    {
        try{
            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/rooms'), $imageName);

            $imgPath = public_path('uploads/roomms');

            $imgPath.= "/{$imageName}";

            $room = Room::create([
                "name" => $request->name,
                "description" => $request->description,
                "room_type_id" => $request->room_type_id,
                "img_path" => $imgPath,
            ]);

            return new RoomResorce($room);
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
            return new RoomResorce(Room::find($id));
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
    public function update(RoomRequest $request, $id)
    {
        try{
            //return 'me';
            $item = Room::find($id);

            if($item){
                if($request->image){
                    $imageName = time().'.'.$request->image->getClientOriginalExtension();

                    $request->image->move(public_path('uploads/rooms'), $imageName);

                    $imgPath = public_path('uploads/roomms');

                    $imgPath.= "/{$imageName}";
                }

                //return $item;
                $request = $item->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status,
                    'discount' => $request->discount,
                    "img_path" => $imgPath,
                    "room_type_id" => $request->room_type_id,
                ]);

                if ($request){
                    //return 'mee';
                    return new RoomResorce($request);
                }

                return response()->json([
                    'error' => 'OOPS! Something went wrong updating room type. Please try again.'
                ], 500);
            }

            return response()->json([
                'error' => 'Room type does not exist'
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
            if(Room::find($id)->delete()){
                return response()->json([
                    'success' => 'Room has successfully been deleted'
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
