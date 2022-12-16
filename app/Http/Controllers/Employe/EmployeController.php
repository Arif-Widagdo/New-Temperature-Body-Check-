<?php

namespace App\Http\Controllers\Employe;

use Ramsey\Uuid\Uuid;
use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        // $year =  $now->year;
        // $month =  $now->month;
        // $weekOfYear =  $now->weekOfYear;
        $time =  Carbon::parse($now)->translatedFormat('l, d F Y');
        $attendances = Absence::where('user_id', auth()->user()->id)->latest()->get();
        $status = 'notaxists';

        foreach ($attendances as $attendance) {
            if ($attendance->presence_date == $time) {
                $status = 'axists';
            }
        }

        return view('employe.dashboard', [
            'status' => $status,
            'time' => $time,
            'attendances' => $attendances,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temperature' => 'required|integer|min:1, max:255',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray(), 'msg' => __('Please complete the input on the form provided')]);
        } else {
            $store = Absence::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => auth()->user()->id,
                'temperature' =>  $request->temperature,
                'presence_date' => now()
            ]);
            if (!$store->save()) {
                return response()->json(['status' => 0, 'msg' => __('Failed')]);
            } else {
                return response()->json(['status' => 1, 'msg' => __('Success')]);
            }
        }
    }

    public function update(Request $request, Absence $absence)
    {
        $this->authorize('update', $absence);

        $validated = $request->validate([
            'temperature' => 'required|string|max:255',
        ]);

        $absence->update($validated);
        return redirect()->back()->with('success', __('Success'));
    }

    public function destroy(Absence $absence)
    {
        $this->authorize('delete', $absence);

        $delete = Absence::destroy($absence->id);
        if ($delete) {
            return redirect()->back()->with('success', __('Success'));
        } else {
            return redirect()->back()->with('error', __('Fail'));
        }
    }
}
