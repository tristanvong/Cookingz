<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FAQProposal;
use App\Models\User;
use App\Models\FAQItem;

class FAQProposalController extends Controller
{
    public function create()
    {
        $categories = Category::where('type', 'faq')->get();
        return view('faqs.proposals.propose', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        FAQProposal::create([
            'user_id' => auth()->id(),
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' => 'pending', 
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('faq-proposals.index')->with('success', 'Your FAQ proposal has been submitted and is awaiting review.');
    }

    public function showOwnProposals()
    {
        $proposals = FAQProposal::where('user_id', auth()->id())->with('category')->get();
        return view('faqs.proposals.myProposals', compact('proposals'));
    }

    public function showProposalByUserId($id)
    {
        $proposals = FAQProposal::where('user_id', $id)->with('category')->get();
        $user = User::find($id);
        return view('faqs.proposals.showProposalByUserId', compact('proposals', 'user'));
    }

    public function approve($id)
    {
        $proposal = FAQProposal::findOrFail($id);
        $proposal->status = 'approved';
        $proposal->save();

        $faq = new FAQItem([
            'question' => $proposal->question,
            'answer' => $proposal->answer,
        ]);
        $faq->save();

        return redirect()->back()->with('success', 'The FAQ proposal has been approved.');
    }

    public function reject($id)
    {
        $proposal = FAQProposal::findOrFail($id);
        $proposal->status = 'rejected';
        $proposal->save();

        return redirect()->back()->with('success', 'The FAQ proposal has been rejected.');
    }
}
