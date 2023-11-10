<?php

declare (strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AskingHelpRequest;
use App\Models\HelpCategory;
use App\Models\HelpRequest;
use App\Models\User;

class HelpRequestController extends Controller
{
    public function store(AskingHelpRequest $request)
    {
        try {
            $user = User::findOrFail($request->user_request_id);
            $category = HelpCategory::findOrFail($request->category_id);
            $helpRequest = new HelpRequest;
            $helpRequest->store($user, $category);

            $helpRequestsMade = HelpRequest::getRequestsMadeByUser($user);

            return response()->json(['message' => 'Help successfully requested.', 'help_requests' => $helpRequestsMade]);

        } catch (\Exception $e) {
            report($e);
            //TODO this will also return error code for user not found or category not found instead of 404
            //TODO we need to adopt certain json format
            return response()->json(['message' => 'Unable to request the help.', 'error' => $e->getMessage()], 500);
        }
    }

    public function requestsMade(User $user)
    {
        $helpRequests = HelpRequest::getRequestsMadeByUser($user);

        return response()->json(['message' => 'Help requests made retrieved successfully.', 'help_requests' => $helpRequests]);
    }

    public function offerHelp(HelpRequest $helpRequest, int $help_request_id)
    {
        //TODO: ensure this person is a valid helper

        $pendingHelpRequest = $helpRequest->pending()
            ->where('id', $help_request_id)
            ->first();

        if(!$pendingHelpRequest){
            //TODO determine the proper status code to send
            return response()->json(['message' => 'Sorry, this request is no longer available'], 422);
        }

        //assign request to helper
        $pendingHelpRequest->assignOffer(auth()->user()->id);

        return response()->json(['message' => 'Help successfully assigned to you'], 200);
    }
}
