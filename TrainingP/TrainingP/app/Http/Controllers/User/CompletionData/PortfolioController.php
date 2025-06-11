<?php

namespace App\Http\Controllers\User\CompletionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequests\deletePortfolio;
use App\Http\Requests\PortfolioRequests\showPortfolio;
use App\Http\Requests\PortfolioRequests\storePortfolio;
use App\Http\Requests\PortfolioRequests\updatePortfolio;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
    }

    public function index(showPortfolio $request)
    {
        $response = $this->portfolioService->showPortfolio();
        return view('portfolio.index', ['portfolios' => $response['data']]);
    }

    public function create()
    {
        return view('portfolio.store');
    }

    public function store(storePortfolio $request)
    {
        $validated = $request->validated();
        $response = $this->portfolioService->storePortfolio($validated);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function edit($id){

        $portfolio = Portfolio::findOrFail($id);

        return view('portfolio.update', compact('portfolio'));
    }

    public function update(updatePortfolio $request, $id)
    {
        $validated = $request->validated();
        $response = $this->portfolioService->updatePortfolio($validated, $id);

        if ($response['success']) {
            return redirect()->route('show_trainer_profile')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']])->withInput();
        }
    }

    public function destroy(deletePortfolio $request, $id)
    {
        $response = $this->portfolioService->deletePortfolio($id);

        if ($response['success']) {
            return redirect()->route('homePage')->with('success', $response['msg']);
        } else {
            return back()->withErrors(['error' => $response['msg']]);
        }
    }

}
