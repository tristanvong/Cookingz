<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\FAQItem;

class FAQController extends Controller
{
    public function index()
    {
        $categories = Category::where('type', 'faq')->with('faqItems')->get();
        return view('faqs.index', compact('categories'));
    }

    public function showCategory($id)
    {
        $category = Category::where('type', 'faq')->where('id', $id)->with('faqItems')->firstOrFail();
        return view('faqs.faqByCategory', compact('category'));
    }

    public function create()
    {
        $categories = Category::where('type', 'faq')->get();
        return view('faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:512',
            'category_id' => 'required|exists:categories,id',
        ]);

        FAQItem::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('faqs.index');
    }

    public function edit($id)
    {
        $faqItem = FAQItem::findOrFail($id);
        $categories = Category::where('type', 'faq')->get();
        return view('faqs.edit', compact('faqItem', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:512',
            'category_id' => 'required|exists:categories,id',
        ]);

        $faqItem = FAQItem::findOrFail($id);

        $faqItem->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'category_id' => $request->input('category_id'),
        ]);

        return redirect()->route('faqs.index');
    }

    public function destroy($id)
    {
        $faqItem = FAQItem::findOrFail($id);
        $faqItem->delete();
        return redirect()->route('faqs.index');
    }
}
