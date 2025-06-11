<?php

namespace App\Http\Controllers\User\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommitmentRequests\deleteCommitmentRequest;
use App\Http\Requests\CommitmentRequests\indexCommitmentRequest;
use App\Http\Requests\CommitmentRequests\StoreCommitmentRequest;
use App\Models\Commitment;
use App\Services\CommitmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommitmentController extends Controller
{
    protected $commitmentService;

    public function __construct(CommitmentService $commitmentService)
    {
        $this->commitmentService = $commitmentService;
    }

    public function index(indexCommitmentRequest $request)
    {
        $commitments = $this->commitmentService->getAllCommitments();
        return view('commitments.index', ['commitments' => $commitments['data']]);
    }

    public function create()
    {

        return view('commitments.create');
    }

    public function store(StoreCommitmentRequest $request)
    {
        $validated = $request->validated();
        $response = $this->commitmentService->createCommitment($validated);

        if ($response['success']) {
            return redirect()->route('commitments.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }



    public function edit($id)
    {
        $commitment = Commitment::findOrFail($id);
        return view('commitments.edit', compact('commitment'));
    }


    public function update(StoreCommitmentRequest $request, $id)
    {
        $validated = $request->validated();
        $response = $this->commitmentService->updateCommitment($validated, $id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteCommitmentRequest $request,Commitment $commitment)
    {
        try {
            $commitment->delete();
            return redirect()->route('commitments.index')->with('success', 'تم حذف الالتزام بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
