<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Insuran_price;
class InsurancePriceController extends Controller {
    public function index() {
        $prices = Insuran_price::where('status', 1)
            ->paginate(15);
        return view('maintenance.insurance_price.index', compact('prices'));
    }
    public function create() { }
    public function store(Request $request) { }
    public function show($id) {
        $price = Insuran_price::find($id);
        return view('maintenance.insurance_price.show', compact('price'));
    }
    public function edit($id) {
        $price = Insuran_price::find($id);
        return view('maintenance.insurance_price.edit', compact('price'));
    }
    public function update(Request $request, $id) {
        $this->validate($request, [
            'price' => 'required|numeric'
        ]);
        $price = Insuran_price::find($id);
        $price->price = $request->price;
        $price->userid_modified = auth()->user()->id;
        if($price->save()) session(['success' => 'Record saved successfully']);
        else session(['error', 'Error on saving the record']);
        return redirect()->route('insurance_price.show', $price->id);
    }
    public function destroy($id) { }
}
