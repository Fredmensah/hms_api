<?php

namespace App\Http\Controllers\Api\v1\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\SizeRequest;
use App\Http\Resources\System\Size\SizeCollection;
use App\Http\Resources\System\Size\SizeResource;
use App\Models\System\Item_Size;
use Illuminate\Database\QueryException;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new SizeCollection(Item_Size::all());
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
    public function store(SizeRequest $request)
    {
        try{
            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/size'), $imageName);

            $imgPath = public_path('uploads/size');

            $imgPath.= "/{$imageName}";

            $category = Item_Size::create([
                "name" => $request->name,
                "img_path" => $imgPath,
            ]);

            return new SizeResource($category);
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
            return new SizeResource(Item_Size::find($id));
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
    public function update(SizeRequest $request, $id)
    {
        try{
            $item = Item_Size::find($id);

            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads/size'), $imageName);

            $imgPath = public_path('uploads/size');

            $imgPath.= "/{$imageName}";

            $category = $item->update([
                "name" => $request->name,
                "img_path" => $imgPath,
                "status" => $request->status,
            ]);

            return new SizeResource($category);
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
            if(Item_Size::findOrFail($id)->delete()){
                return response()->json([
                    'success' => 'Size has successfully been deleted'
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
