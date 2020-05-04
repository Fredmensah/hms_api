<?php

namespace App\Http\Controllers\Api\v1\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookRequest;
use App\Http\Resources\Bookings\BookCollection;
use App\Http\Resources\Bookings\BookResource;
use App\Models\Bookings\Book;
use App\Models\Bookings\Booking;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new BookCollection(Booking::all());
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
    public function store(BookRequest $request)
    {
        try{
            $booking = Booking::create([
                "checkIn" => $request->checkIn,
                "checkOut" => $request->checkOut,
                "type" => $request->type,
                "room_id" => $request->room_id,
                "customer_id" => $request->customer_id,
                "room_discount" => $request->room_discount,
                "room_type_discount" => $request->room_type_discount,
                "price" => $request->price,
                "status" => $request->status,
                "created_by" => $request->created_by,
            ]);

            return new BookResource($booking);
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
            return new BookResource(Booking::find($id));
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
    public function update(BookRequest $request, $id)
    {
        try{
            //return 'me';
            $item = Book::find($id);

            if($item){
                //return $item;
                $request = $item->update([
                    "checkIn" => $request->checkIn,
                    "checkOut" => $request->checkOut,
                    "type" => $request->type,
                    "room_id" => $request->room_id,
                    "customer_id" => $request->customer_id,
                    "room_discount" => $request->room_discount,
                    "room_type_discount" => $request->room_type_discount,
                    "price" => $request->price,
                    "status" => $request->status,
                    "created_by" => $request->created_by,
                ]);

                if ($request){
                    //return 'mee';
                    return new BookResource($request);
                }

                return response()->json([
                    'error' => 'OOPS! Something went wrong updating booking. Please try again.'
                ], 500);
            }

            return response()->json([
                'error' => 'Booking does not exist'
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
            if(Booking::find($id)->delete()){
                return response()->json([
                    'success' => 'Booking has successfully been deleted'
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
