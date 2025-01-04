<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQProposal;

class FAQProposalController extends Controller
{
    public function create()
    {
        return view('faqs.propose');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        FAQProposal::create([
            'user_id' => auth()->id(),
            'question' => $request->input('question'),
            'status' => 'pending', 
        ]);

        return redirect()->route('faqs.index')->with('status', 'Your FAQ proposal has been submitted and is awaiting review.');
    }

    public function index()
    {
        $proposals = FAQProposal::where('user_id', auth()->id())->get();
        return view('faqs.myProposals', compact('proposals'));
    }
}
