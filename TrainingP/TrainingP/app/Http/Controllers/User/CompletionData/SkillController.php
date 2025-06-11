<?php

namespace App\Http\Controllers\User\CompletionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequests\destroySkillRequest;
use App\Http\Requests\SkillRequests\storeSkillRequest;
use App\Http\Requests\SkillRequests\updateSkillRequest;
use App\Models\Skill;
use App\Services\SkillService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    public function index()
    {
        $response = $this->skillService->showSkill();
        return view('skills.index', ['skills' => $response['data']]);
    }
    public function create()
    {
        return view('skills.create');
    }
    public function store(storeSkillRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['users_id'] = auth()->id();

        $response = $this->skillService->storeSkill($validatedData);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }
    public function edit(Skill $skill)
    {
        if ($skill->users_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('skills.edit', compact('skill'));
    }
    public function update(updateSkillRequest $request, Skill $skill)
    {
        if ($skill->users_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validated();

        $response = $this->skillService->updateSkill($skill, $validatedData);

        if ($response['success']) {
            return redirect()->route('skills.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }
    public function destroy(destroySkillRequest $request,Skill $skill)
    {
        if ($skill->users_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $response = $this->skillService->deleteSkill($skill);

        if ($response['success']) {
            return redirect()->route('skills.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
