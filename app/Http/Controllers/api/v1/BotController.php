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
     * Display a listing of the api docs.
     * @return \Illuminate\Http\Response
     */
    public function docs()
    {
        $apiDocs = [
            'DOCS' => 'метод:GET, URL:http:{URL}/api/v1/bots',
            'REGISTER' => 'метод:POST, URL:http:{URL}/api/v1/registration',
            'LOGIN ' => 'метод:GET, URL:http:{URL}/api/v1/login',
            'LOGOUT' => 'метод:POST, URL:http:{URL}/api/v1/logout',
            'ACCOUNT' => 'метод:POST, URL:http:{URL}/api/v1/account',
            'ALL BOTS' => 'метод:GET, URL:http:{URL}/api/v1/bots/index',
            'DESTROY BOT' => 'метод:POST, URL:http:{URL}/api/v1/bots/{id}/destroy',
            'SHOW BOT' => 'метод:GET, URL:http:{URL}/api/v1/bots/{id}/show',
            'NEW BOT' => 'метод:POST, URL:http:{URL}/api/v1/bots/create',
            'EDIT BOT' => 'метод:POST, URL:http:{URL}/api/v1/bots/update'

        ];
        return $this->sendResponse($apiDocs, 'API DOCS BOTS .');
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
            if ($bot && $bot->user_id === auth()->user()->id) {
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
            $bot->user_id = auth()->user()->id;
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
        if (auth()->user()) {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['string', 'max:255']
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 400);
            }
            $bot = Bot::where('id', '=', $id)->first();

            if ($bot && $bot->user_id === auth()->user()->id) {

                $bot->name = $request->name;
                $bot->description = $request->description;
                if ($bot->save()) {
                    return $this->sendResponse($bot, 'Bot changed!');
                }

                return $this->sendError('An error occurred while making changes to the bot.', [], 400);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
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
