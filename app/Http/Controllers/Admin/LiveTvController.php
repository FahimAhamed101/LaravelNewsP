<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveTv;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiveTvController extends Controller
{
    public function index()
    {
        $data = LiveTv::findOrFail(1);

        return view('admin.livetv.index', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:live_tvs,id'],
            'url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $liveTv = LiveTv::findOrFail($validated['id']);

        if ($request->hasFile('image')) {
            if ($liveTv->image && ! str_starts_with($liveTv->image, 'http')) {
                @unlink(public_path($liveTv->image));
            }

            if (! is_dir(public_path('storage/livetvbgimage'))) {
                mkdir(public_path('storage/livetvbgimage'), 0755, true);
            }

            $image = $request->file('image');
            $filename = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/livetvbgimage'), $filename);

            $liveTv->image = 'storage/livetvbgimage/'.$filename;
        }

        $liveTv->url = $validated['url'] ?? null;
        $liveTv->post_date = Carbon::now()->format('d F Y');
        $liveTv->save();

        $notification = [
            'message' => 'Live Tv Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }
}
