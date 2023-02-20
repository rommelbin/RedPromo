<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionDistribution;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MainController extends BaseController
{
    public function index(
        Request $request,
        string  $model,
        string  $method,
        ?int    $id = null
    )
    {
        try {
            $modelRepositoryClass = $request->params['modelRepositoryClass'];
            $res = $modelRepositoryClass::$method($request->all(), $id);
            return response()->json($res, $res['status'] ?? 200);

        } catch (\Exception $exception) {
            return ExceptionDistribution::defineException($exception);
        }
    }


    /**
     * @throws \Exception
     */
    public function register(Request $request)
    {
        try {
            $response = UserRepository::register($request->all());

            return response()->json($response, $response['status'] ?? 200);
        } catch (\Exception $exception) {
            return ExceptionDistribution::defineException($exception);
        }
    }

    /**
     * @throws \Exception
     */
    public function login(Request $request)
    {
        try {
        $response = UserRepository::login($request->all());

        return response()->json($response, $response['status'] ?? 200);
        } catch (\Exception $exception) {
            return ExceptionDistribution::defineException($exception);

        }
    }

}
