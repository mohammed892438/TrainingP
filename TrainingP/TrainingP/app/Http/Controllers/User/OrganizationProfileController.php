<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ChallengeAndProblemService;
use App\Services\CollaborationService;
use App\Services\CommitmentService;
use App\Services\GoalService;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationProfileController extends Controller
{
    protected $organizationService;
    protected $challengeAndProblemService;

    protected $commitmentService;

    protected $goalService;

    protected $collaborationService;

    public function __construct(OrganizationService $organizationService , 
        ChallengeAndProblemService $challengeAndProblemService ,
        CommitmentService $commitmentService,
        GoalService $goalService,
        CollaborationService $collaborationService,
    )
    {
        $this->organizationService = $organizationService;
        $this->challengeAndProblemService = $challengeAndProblemService;
        $this->commitmentService = $commitmentService;
        $this->goalService = $goalService;
        $this->collaborationService = $collaborationService;
    }
    public function showOrganizationProfile()
{
    $organizationService = $this->organizationService->getOrganizationForUser();
    $organization = $organizationService['data']->first();
    $challengeAndProblemService = $this->challengeAndProblemService->showchallengeAndProblem();
    $challenges = collect($challengeAndProblemService['data']);
    $commitmentService = $this->commitmentService->getAllCommitments();
    $commitment = collect($commitmentService['data']);
    $goalService = $this->goalService->showGoal();
    $goal = collect($goalService['data']);
    $collaborationService = $this->collaborationService->showcollaborations();
    $collaboration = collect($collaborationService['data']);
    $user = Auth::user();
    return view('organization.organizationProfil', [
        'user' => $user,
        'organization' => $organization, 
        'challenges' => $challenges,
        'commitments' => $commitment,
        'goals' => $goal,
        'collaborations' => $collaboration,
    ]);
}
}
