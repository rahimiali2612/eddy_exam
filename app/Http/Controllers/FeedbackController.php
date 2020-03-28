<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\GetFilterRequest;
use App\Feedback;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $filter=new GetFilterRequest();
            $feedbackList = Feedback::all();
            $orm=$filter->parse($feedbackList);
            $orm->get();

            if($feedbackList->isEmpty()){
                return response()->json(['results' => 'No data'], 204);
            }

            return response()->json(['results' => $feedbackList], 200);
        }catch(Exception $e){
            return response()->json(['results' => $e], 400);
        }
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

            $validator = Validator::make($request->all(), [
                'subject' => 'required',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return json_encode(['error' => $validator->messages()->all()]);
            }

            $input = $request->all();
            $model = new Feedback();
            $model->fill($input);
            $model->save();

            return response()->json(['results' => 'Data Saved'], 200);

        }catch (Exception $e){

            return response()->json(['results' => $e], 400);

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
            $feedback = Feedback::where('id', $id)->first();

            if(is_null($feedback)){
                return response()->json(['results' => 'No Data'], 204);
            }

            return response()->json(['results' => $feedback], 200);
        }catch(Exception $e){
            return response()->json(['results' => $e], 400);
        }
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
            $validator = Validator::make($request->all(), [
                'status' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['results' => $validator->errors()], 400);
            }

            $feedback = Feedback::find($id);

            $feedback->status = $request->status;

            $feedback->save();

            return response()->json(['results' => 'Status Updated'], 200);

        }catch(Exception $e){
            return response()->json(['results' => $e], 400);
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
            $feedback = Feedback::find($id)->delete();

            return response()->json(['results' => 'Deleted'], 200);
        }catch(Exception $e){
            return response()->json(['results' => $e], 400);
        }
    }
}
