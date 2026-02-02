<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PiglyRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PiglyController extends Controller
{
    public function index()
    {
        return $this->buildMainView();
    }

    public function store(PiglyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        WeightLog::create($data);

        return redirect('/weight_logs');
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        $user = auth()->user();
        $logsQuery = WeightLog::where('user_id', $user->id)->orderBy('date', 'desc');

        if ($request->filled('from')) {
            $logsQuery->whereDate('date', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $logsQuery->whereDate('date', '<=', $request->input('to'));
        }

        return $this->buildMainView($logsQuery);
    }

    public function show($weightLogId)
    {
        $user = auth()->user();
        $record = WeightLog::where('user_id', $user->id)->findOrFail($weightLogId);

        return view('detail', ['record' => $record]);
    }

    public function update(PiglyRequest $request, $weightLogId)
    {
        $user = auth()->user();
        $record = WeightLog::where('user_id', $user->id)->findOrFail($weightLogId);

        $data = $request->validated();

        $record->update($data);

        return redirect("/weight_logs/{$weightLogId}");
    }

    public function destroy($weightLogId)
    {
        $user = auth()->user();
        $record = WeightLog::where('user_id', $user->id)->findOrFail($weightLogId);
        $record->delete();

        return redirect('/weight_logs');
    }

    public function goalSetting()
    {
        $target = WeightTarget::where('user_id', auth()->id())->latest()->first();

        return view('target', [
            'targetWeight' => $target ? $target->target_weight : null,
        ]);
    }

    public function goalUpdate(PiglyRequest $request)
    {
        $data = $request->validated();

        $target = WeightTarget::firstOrNew(['user_id' => auth()->id()]);
        $target->target_weight = $data['target_weight'];
        $target->save();

        return redirect('/weight_logs');
    }

    public function registerStep2(PiglyRequest $request)
    {
        $data = $request->validated();

        $userId = auth()->id();

        WeightLog::create([
            'user_id' => $userId,
            'date' => now()->toDateString(),
            'weight' => $data['weight'],
            'calories' => null,
            'exercise_time' => null,
            'exercise_content' => null,
        ]);

        $target = WeightTarget::firstOrNew(['user_id' => $userId]);
        $target->target_weight = $data['target_weight'];
        $target->save();

        return redirect('/weight_logs');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    private function buildMainView(?Builder $logsQuery = null)
    {
        $user = auth()->user();
        $logsQuery = $logsQuery ?? WeightLog::where('user_id', $user->id)->orderBy('date', 'desc');
        $records = $logsQuery->paginate(8);
        $latestLog = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->first();
        $target = WeightTarget::where('user_id', $user->id)->latest()->first();

        $targetWeight = $target ? $target->target_weight : 0;
        $latestWeight = $latestLog ? $latestLog->weight : 0;
        $records->target_weight = $targetWeight;
        $records->latest_weight = $latestWeight;
        $records->target_diff = $targetWeight - $latestWeight;

        return view('main', ['records' => $records]);
    }
}
