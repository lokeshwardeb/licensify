<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use Carbon\Carbon;

class LicenseApiController extends Controller
{
    /**
     * Verify license API
     * 
     * Request: POST /api/verify-license
     * Body: { "license_key": "XXXX" }
     */
    public function verify(Request $request)
    {
        // $request->validate([
        //     'license_key' => 'required|string|max:255',
        // ]);

        // Query the license directly from the model
        $license = License::where('license_key', $request->license_key)->first();

        // dd($license);

        // exit;

        if (!$license) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid license key.',
            ], 404);
        }

        if (!$license->is_active) {
            return response()->json([
                'status' => 'error',
                'message' => 'License is deactivated.',
            ], 403);
        }

        if ($license->expires_at && Carbon::parse($license->expires_at)->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'License has expired.',
            ], 403);
        }

        return response()->json([
            // 'status' => 'success',
            'status' => 'valid',
            'message' => 'License is valid.',
            'data' => [
                'status' => 'valid',
                'license_key' => $license->license_key,
                'customer_name' => $license->customer_name,
                'expires_at' => $license->expires_at,
                'is_active' => $license->is_active,
            ],
        ]);
    }

    public function checkUpdate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'domain'      => 'required|url',
            'version'     => 'required|string',
        ]);

        $licenseKey = $request->license_key;
        $domain     = $request->domain;
        $currentVersion = $request->version;

        // Validate license key
        $license = \App\Models\License::where('license_key', $licenseKey)->first();

        if (!$license || !$license->is_active) {
            return response()->json([
                'error' => 'Invalid license or inactive',
            ], 403);
        }

        // Example: new theme version info
        $latestVersion = '1.1.0';
        // $downloadUrl   = 'https://your-server.com/downloads/shopforge-premium-theme.zip';
        $downloadUrl   = 'https://your-server.com/downloads/shopforge-premium-theme.zip';

        if (version_compare($currentVersion, $latestVersion, '<')) {
            return response()->json([
                'new_version' => $latestVersion,
                // 'download_url' => url('/secure-update-download/' . $request->license_key)
                'download_url' => $downloadUrl
            ]);
        }

        return response()->json([]); // no update available
    }
}



// // ✅ Secure download
//     public function secureDownload($licenseKey)
//     {
//         $license = License::where('license_key', $licenseKey)->first();

//         if (!$license || !$license->is_active) {
//             abort(403, 'Unauthorized access');
//         }

//         $filePath = base_path('secure-downloads/shopforge-premium-theme.zip');

//         if (!file_exists($filePath)) {
//             abort(404, 'File not found');
//         }

//         return response()->download($filePath);
//     }
