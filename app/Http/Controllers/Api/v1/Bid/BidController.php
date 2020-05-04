<?php

namespace App\Http\Controllers\Api\v1\Bid;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bid\BidRequest;
use App\Http\Resources\Bid\BidCollection;
use App\Http\Resources\Bid\BidResource;
use App\Http\Resources\Request\RequestCollection;
use App\Http\Resources\Request\RequestResource;
use App\Models\Bid\Bid;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new BidCollection(Bid::all());
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
    public function getUsersBidOne($bid_uuid)
    {
        try{
            return new RequestResource(Bid::where('user_uuid' , Auth::user()->uuid)
                ->where('uuid' , $bid_uuid)->first());
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
    public function getUsersBid()
    {
        try{
            return new RequestCollection(Bid::where('user_uuid' , Auth::user()->uuid)->get());
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
    public function store(BidRequest $request)
    {
        try{
            $bid = Bid::create([
                'user_uuid' => Auth::user()->uuid,
                'request_uuid' => $request->request_uuid,
                'amount' => $request->amount,
                'departure_date' => $request->departureDate,
                'arrival_date' => $request->arrivalDate,
            ]);

            /*
             * @todo Check Bid Resource out....Information breaks.
             * */
            if ($request){
                return $bid;

                //return new BidResource($bid);
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
            return Bid::where('uuid' , $uuid)->first();
            return new BidResource(Bid::where('uuid' , $uuid)->first());
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
    public function update(BidRequest $request, $uuid)
    {
        try{
            //return 'me';
            $item = Bid::where('uuid' , $uuid)
                ->where('user_uuid' , Auth::user()->uuid)->first();

            if($item){
                //return $item;
                $request = $item->update([
                    'user_uuid' => Auth::user()->uuid,
                    'request_uuid' => $request->request_uuid,
                    'amount' => $request->amount,
                    'departure_date' => $request->departureDate,
                    'arrival_date' => $request->arrivalDate,
                ]);

                if ($request){
                    //return 'mee';
                    return $item;
                    return new BidResource($request);
                }

                return response()->json([
                    'error' => 'OOPS! Something went wrong updating bid. Please try again.'
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
            if((Bid::where('uuid' , $uuid)
                ->where('user_uuid' , Auth::user()->uuid)->first())->delete()){
                return response()->json([
                    'success' => 'Bid has successfully been deleted'
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
