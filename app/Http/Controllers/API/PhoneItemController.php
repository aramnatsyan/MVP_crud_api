<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PhoneItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PhoneItemResource;
use GuzzleHttp\Client;

class PhoneItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phoneItems = PhoneItem::all();
        return response([ 'phone_items' => PhoneItemResource::collection($phoneItems), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'f_name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'country_code' => 'required|max:255',
            'timezone_name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $client = new Client();
        $response = $client->get('http://country.io/continent.json');
        $array = json_decode($response->getBody()->getContents(), true);

        if (!empty($array)) {
            if (array_key_exists($data['country_code'], $array)) {
                $response = $client->get('http://worldtimeapi.org/api/timezone');
                $timeZones = json_decode($response->getBody()->getContents(), true);

                if (!empty($timeZones)) {
                    if (in_array($data['timezone_name'], $timeZones)) {
                            $phoneItem = PhoneItem::create($data);
                            return response(['phone_item' => new PhoneItemResource($phoneItem), 'message' => 'Created successfully'], 201);
                    }
                    else {
                        return response(['error' => 'Invalid Time Zone Name'], 400);
                    }
                }
            }
            else {
                return response(['error' => 'Invalid Country Code'], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhoneItem  $phoneItem
     * @return \Illuminate\Http\Response
     */
    public function show(PhoneItem $phoneItem)
    {
        return response(['phone_item' => new PhoneItemResource($phoneItem), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhoneItem  $phoneItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhoneItem $phoneItem)
    {
        $phoneItem->update($request->all());

        return response(['phone_item' => new PhoneItemResource($phoneItem), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhoneItem  $phoneItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhoneItem $phoneItem)
    {
        $phoneItem->delete();

        return response(['message' => 'Deleted']);
    }
}
