<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\challengeAndProblemRequests\deleteChallengAndProblemRequest;
use App\Http\Requests\challengeAndProblemRequests\showChallengAndProblemRequest;
use App\Http\Requests\challengeAndProblemRequests\storeChallengAndProblemRequest;
use App\Http\Requests\challengeAndProblemRequests\updateChallengAndProblemRequest;
use App\Models\ChallengesAndProblem;
use App\Services\ChallengeAndProblemService;
use Illuminate\Http\Request;

class ChallengeAndProblemController extends Controller
{
    protected $ChallengeAndProblemService;

    public function __construct(ChallengeAndProblemService $ChallengeAndProblemService)
    {
        $this->ChallengeAndProblemService = $ChallengeAndProblemService;
    }

    public function index(showChallengAndProblemRequest $request)
    {
        $response = $this->ChallengeAndProblemService->showchallengeAndProblem();
        return view('challengeAndProblems.index', ['challengeAndProblems' => $response['data']]);
    }

    public function create()
    {
        return view('challengeAndProblems.store');
    }

    public function store(storeChallengAndProblemRequest $request)
    {
        $validated = $request->validated();
        $response = $this->ChallengeAndProblemService->storechallengeAndProblem($validated);

        if ($response['success']) {
            return redirect()->route('challengeAndProblems.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $challengeAndProblems = ChallengesAndProblem::findOrFail($id);
        return view('challengeAndProblems.update', compact('challengeAndProblems'));
    }


    public function update(updateChallengAndProblemRequest $request, $id)
    {
        $validated = $request->validated();
        $response = $this->ChallengeAndProblemService->updatechallengeAndProblem($validated, $id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteChallengAndProblemRequest $request,$id)
    {
        $response = $this->ChallengeAndProblemService->deletechallengeAndProblem($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
