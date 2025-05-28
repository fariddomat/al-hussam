<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $sliders = \App\Models\Slider::orderBy('order_num')->get();
//         foreach ($sliders as $index => $slider) {
//     $slider->update(['order_num' => $index + 1]);
// }
        return view('dashboard.sliders.index', compact('sliders'));
    }

    public function create()
    {

        return view('dashboard.sliders.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

         $maxOrder = Slider::max('order_num') ?? 0;
        $validated['order_num'] = $maxOrder + 1;

        $slider = \App\Models\Slider::create($validated);

        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function show($id)
    {
        $slider = \App\Models\Slider::findOrFail($id);

        return view('dashboard.sliders.show', compact('slider'));
    }

    public function edit($id)
    {
        $slider = \App\Models\Slider::findOrFail($id);

        return view('dashboard.sliders.edit', compact('slider', ));
    }

    public function update(Request $request, $id)
    {
        $slider = \App\Models\Slider::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($slider->img) Storage::delete($slider->img);
        }

        $slider->update($validated);

        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider updated successfully.');
    }

        public function destroy($id)
    {
        $slider = \App\Models\Slider::findOrFail($id);
        $slider->delete();
        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider deleted successfully.');
    }
    public function restore($id)
    {
        $slider = \App\Models\Slider::withTrashed()->findOrFail($id);
        $slider->restore();
        return redirect()->route('dashboard.sliders.index')->with('success', 'Slider restored successfully.');
    }
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*.id' => 'required|exists:sliders,id',
            'order.*.order_num' => 'nullable|integer|min:0',
        ]);

        foreach ($request->order as $index => $item) {
            \App\Models\Slider::where('id', $item['id'])->update(['order_num' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated successfully']);
    }
}
