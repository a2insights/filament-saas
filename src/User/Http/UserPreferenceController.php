<?php

namespace A2Insights\FilamentSaas\User\Http\Controllers;

use A2Insights\FilamentSaas\User\UserPreferences;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $preferences = $user->preferences;

        // Ensure we have a UserPreferences object
        if (! $preferences) {
            $preferences = new UserPreferences;
        }

        if ($request->has('dismiss_alert')) {
            $alertId = $request->input('dismiss_alert');
            $dismissed = $preferences->dismissed_alerts;
            if (! in_array($alertId, $dismissed)) {
                $dismissed[] = $alertId;
            }
            $preferences->dismissed_alerts = $dismissed;
        }

        if ($request->has('toggle_collapse_alert')) {
            $alertId = $request->input('toggle_collapse_alert');
            $collapsed = $preferences->collapsed_alerts;
            $isCollapsed = $request->input('is_collapsed', true);

            if ($isCollapsed) {
                if (! in_array($alertId, $collapsed)) {
                    $collapsed[] = $alertId;
                }
            } else {
                $collapsed = array_filter($collapsed, fn ($id) => $id !== $alertId);
                $collapsed = array_values($collapsed);
            }
            $preferences->collapsed_alerts = $collapsed;
        }

        if ($request->has('show_alerts_globally')) {
            $preferences->show_alerts_globally = (bool) $request->input('show_alerts_globally');
        }

        $user->update(['preferences' => $preferences]);

        return response()->json(['success' => true]);
    }
}
