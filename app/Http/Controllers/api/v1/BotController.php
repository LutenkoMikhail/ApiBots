<?php

namespace App\Http\Controllers\Api\v1;

use App\Bot;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BotController extends BaseController
{
    /**
     * BotController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBots = auth()->user()->bots()->orderby('updated_at', 'desc')->get();
        return $this->sendResponse($allBots->toArray(), 'Bots retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()) {
            $bot = Bot::where('id', '=', $id)->first();
            if ($bot && $bot->id === auth()->user()->id) {
                return $this->sendResponse($bot, 'Bot received!');
            }
            return $this->sendError('Load bot error.', ['bot ' => $id], 400);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()) {
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['string', 'max:255']
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 400);
            }
            $bot = new \App\Bot();
            $bot->name = $request->name;
            $bot->description = $request->description;
            $bot->user_id =auth()->user()->id;

            if ($bot->save()) {
                return $this->sendResponse(['bot ' => $bot->id], 'The new bot has been created!');
            }
            return $this->sendError('An error occurred while creating a new bot.', [], 400);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (auth()->user()) {
            $result = Bot::where('id', '=', $id)->delete();
            if ($result) {
                return $this->sendResponse(['bot ' => $id], 'Bot has been successfully deleted!');
            } else {
                return $this->sendError('Delete Error.', ['bot ' => $id], 400);
            }

        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
