<?php

namespace App\Http\Controllers;

use App\Action\UploadImageAction;
use App\Http\Requests\AdvertisingCampaignRequest;
use App\Http\Resources\AdvertisingCampaignResource;
use App\Models\AdvertisingCampaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Response;

class AdvertisingCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AdvertisingCampaignResource::collection(AdvertisingCampaign::all());
    }

    /**
     * AdvertisingCampaign a newly created resource in storage.
     *
     * @param \App\Http\Requests\AdvertisingCampaignRequest $request
     * @param \App\Action\UploadImageAction $uploadImageAction
     * @return \App\Http\Resources\AdvertisingCampaignResource
     */
    public function store(AdvertisingCampaignRequest $request, UploadImageAction $uploadImageAction): AdvertisingCampaignResource
    {
        $advertisingCampaign = AdvertisingCampaign::create($request->validated());

        if($request->file('images')) {
            $advertisingCampaign['images'] =  $uploadImageAction($request);
        }

        return AdvertisingCampaignResource::make($advertisingCampaign);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\AdvertisingCampaign $advertisingCampaign
     * @return \App\Http\Resources\AdvertisingCampaignResource
     */
    public function show(AdvertisingCampaign $advertisingCampaign): AdvertisingCampaignResource
    {
        return AdvertisingCampaignResource::make($advertisingCampaign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\AdvertisingCampaignRequest $request
     * @param \App\Models\AdvertisingCampaign $advertisingCampaign
     * @param \App\Action\UploadImageAction $uploadImageAction
     * @return \App\Http\Resources\AdvertisingCampaignResource
     */
    public function update(
        AdvertisingCampaignRequest $request,
        AdvertisingCampaign $advertisingCampaign,
        UploadImageAction $uploadImageAction
    ): AdvertisingCampaignResource {
        $data = $request->except('images');

        if($request->file('images')) {
            $data['images'] =  $uploadImageAction($request);
        }

        $advertisingCampaign->update($data);

        return AdvertisingCampaignResource::make($advertisingCampaign->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AdvertisingCampaign $advertisingCampaign
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AdvertisingCampaign $advertisingCampaign): JsonResponse
    {
        $advertisingCampaign->delete();

        return Response::json([
            'message' => 'Advertising Campaign deleted successfully.'
        ]);
    }
}
