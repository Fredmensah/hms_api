<?php

namespace App\Http\Controllers\Api\v1\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomTypeRequest;
use App\Http\Resources\Room\RoomTypeCollection;
use App\Http\Resources\Room\RoomTypeResorce;
use App\Models\Room\RoomType;
use Illuminate\Database\QueryException;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new RoomTypeCollection(RoomType::all());
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
    public function store(RoomTypeRequest $request)
    {
        try{
            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/room_type'), $imageName);

            $imgPath = public_path('uploads/room_type');

            $imgPath.= "/{$imageName}";

            $room_type = RoomType::create([
                "name" => $request->name,
                "img_path" => $imgPath,
            ]);

            return new RoomTypeResorce($room_type);
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
            return new RoomTypeResorce(RoomType::find($id));
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
    public function update(RoomTypeRequest $request, $id)
    {
        try{
            //return 'me';
            $item = RoomType::find($id);

            if($item){
                //return $item;
                $request = $item->update([
                    'name' => $request->name,
                    'status' => $request->status,
                    'discount' => $request->discount,
                ]);

                if ($request){
                    //return 'mee';
                    return new RoomTypeResorce($request);
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
            if(RoomType::find($id)->delete()){
                return response()->json([
                    'success' => 'Room type has successfully been deleted'
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
