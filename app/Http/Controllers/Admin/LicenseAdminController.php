<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use Carbon\Carbon;

class LicenseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protect all routes
    }

    public function index()
    {
        $licenses = License::orderBy('id','desc')->get();
        return view('admin.licenses.index', compact('licenses'));
    }

    public function create() { return view('admin.licenses.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'=>'required|string|max:255',
            'expires_at'=>'nullable|date'
        ]);

        $license = new License();
        $license->license_key = strtoupper(bin2hex(random_bytes(8)));
        $license->customer_name = $request->customer_name;
        $license->expires_at = $request->expires_at;
        $license->is_active = true;
        $license->save();

        return redirect()->route('licenses.index')->with('success','License created!');
    }

    public function edit(License $license){ return view('admin.licenses.edit', compact('license')); }

    public function update(Request $request, License $license)
    {
        $request->validate([
            'customer_name'=>'required|string|max:255',
            'expires_at'=>'nullable|date',
            'is_active'=>'required|boolean'
        ]);

        $license->customer_name = $request->customer_name;
        $license->expires_at = $request->expires_at;
        $license->is_active = $request->is_active;
        $license->save();

        return redirect()->route('licenses.index')->with('success','License updated!');
    }

    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('licenses.index')->with('success','License deleted!');
    }
}

