<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollaborationRequests\deleteCollaboration;
use App\Http\Requests\CollaborationRequests\showCollaboration;
use App\Http\Requests\CollaborationRequests\storeCollaboration;
use App\Http\Requests\CollaborationRequests\updateCollaboration;
use App\Models\Collaboration;
use App\Models\Coporation;
use App\Services\CollaborationService;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    protected $collaborationService;

    public function __construct(CollaborationService $collaborationService)
    {
        $this->collaborationService = $collaborationService;
    }

    public function index(showCollaboration $request)
    {

        $response = $this->collaborationService->showcollaborations();
        return view('collaborations.index', ['collaborations' => $response['data']]);
    }

    public function create()
    {

        $corporations = Coporation::all();
        return view('collaborations.store' , compact('corporations' ));
    }

    public function store(storeCollaboration $request)
    {
        $validated = $request->validated();
        $response = $this->collaborationService->storecollaboration($validated);

        if ($response['success']) {
            return redirect()->route('collaborations.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id)
    {
        $corporations = Coporation::all();
        $collaboration = Collaboration::findOrFail($id);
        return view('collaborations.update', compact('collaboration' , 'corporations'));
    }


    public function update(updateCollaboration $request, $id)
    {
        $validated = $request->validated();
        $response = $this->collaborationService->updatecollaboration($validated, $id);

        if ($response['success']) {
            return redirect()->route('collaborations.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deleteCollaboration $request,$id)
    {
        $response = $this->collaborationService->deletecollaboration($id);

        if ($response['success']) {
            return redirect()->route('collaborations.index')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }
}
