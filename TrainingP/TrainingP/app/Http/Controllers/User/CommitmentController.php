<?php

namespace App\Http\Controllers\User;

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
        $commitments = $this->commitmentService->getAllCommitments(Auth::id());
        return view('commitments.index', ['commitments' => $commitments['data']]);
    }

    public function create()
    {
        return view('commitments.create');
    }

    public function store(StoreCommitmentRequest $request)
    {
        $data = $request->validated();
        $data['organization_id'] = Auth::id();
        try {
            $this->commitmentService->createCommitment($data);
            return redirect()->route('commitments.index')->with('success', 'تم إنشاء الالتزام بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Commitment $commitment)
    {
        return view('commitments.edit', compact('commitment'));
    }

    public function update(StoreCommitmentRequest $request, Commitment $commitment)
    {
        try {
            $this->commitmentService->updateCommitment($commitment, $request->validated());
            return redirect()->route('commitments.index')->with('success', 'تم تحديث الالتزام بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
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
