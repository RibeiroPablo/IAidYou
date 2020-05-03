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

            return response()->json(['message' => 'Unable to request the help.', 'error' => $e->getMessage()], 500);
        }
    }

    public function requestsMade(User $user)
    {
        $helpRequests = HelpRequest::getRequestsMadeByUser($user);

        return response()->json(['message' => 'Help requests made retrieved successfully.', 'help_requests' => $helpRequests]);
    }
}
