<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
        return view('faqs.category', compact('category'));
    }
}
