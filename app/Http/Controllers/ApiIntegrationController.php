<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 14/05/2020
 * Time: 17:35
 *
 * Class Stripe
 *
 * @package App\Http\Controllers
 */
class ApiIntegrationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('index', [
            'cssVersion' => md5(file_get_contents(__DIR__ . '/../../../public/css/app.css')),
            'jsVersion'  => md5(file_get_contents(__DIR__ . '/../../../public/js/app.js')),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return false|string
     * @throws \Throwable
     */
    public function apiGetRequest(Request $request)
    {
        try {
            $client   = new \GuzzleHttp\Client();
            $response = $client->request('GET', $request->post('url'));

            /**
             * Validate JSON
             */
            $responseObj  = json_decode($response->getBody());
            $validatorObj = json_decode(file_get_contents(__DIR__ . '/../../JsonSchema/api.json'));
            $validator    = new \JsonSchema\Validator;
            $validator->validate($responseObj, $validatorObj);

            /**
             * Check Validation JSON
             */
            if ($validator->isValid()) {
                $obj = json_decode($response->getBody());

                return json_encode([
                    'success' => true,
                    'raw'     => $obj,
                    'html'    => view('table', [
                        'obj' => $obj,
                    ])->render(),
                ], JSON_PRETTY_PRINT);
            } else {
                return json_encode(
                    [
                        'success' => false,
                        'message' => 'Something went wrong in the JSON Schema Validation',
                        'errors'  => $validator->getErrors(),
                    ], JSON_PRETTY_PRINT
                );
            }
        } catch (\Exception $e) {
            return json_encode(
                [
                    'success' => false,
                    'message' => 'Something went wrong in API request',
                ], JSON_PRETTY_PRINT
            );
        }
    }
}