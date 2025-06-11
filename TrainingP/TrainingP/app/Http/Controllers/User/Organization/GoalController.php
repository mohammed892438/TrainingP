<?php

namespace App\Http\Controllers\User\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoalRequests\deleteGoal;
use App\Http\Requests\GoalRequests\showGoal;
use App\Http\Requests\GoalRequests\storeGoal;
use App\Http\Requests\GoalRequests\updateGoal;
use App\Models\Goal;
use App\Services\GoalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    protected $goalService;

    public function __construct(GoalService $goalService)
    {
        $this->goalService = $goalService;
    }

    public function index(showGoal $request)
    {
        $response = $this->goalService->showGoal();
        return view('goals.index', ['goals' => $response['data']]);
    }

    public function create()
    {
        return view('goals.store');
    }

    public function store(storeGoal $request)
    {
        $validated = $request->validated();
        $response = $this->goalService->storeGoal($validated);

        if ($response['success']) {
            return redirect()->route('goals.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        return view('goals.update', compact('goal'));
    }


    public function update(updateGoal $request, $id)
    {
        $validated = $request->validated();
        $response = $this->goalService->updateGoal($validated, $id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteGoal $request,$id)
    {
        $response = $this->goalService->deleteGoal($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
