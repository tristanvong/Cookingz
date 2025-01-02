<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsItem;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->query('sort', 'desc');
        $newsItems = NewsItem::orderBy('published_at', $sortOrder)->get();
    
        return view('news.index', [
            'newsItems' => $newsItems,
            'sortOrder' => $sortOrder,
        ]);
    }

    public function show(NewsItem $newsItem)
    {
        return view('news.show', compact('newsItem'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date|before_or_equal:today',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        NewsItem::create($validated);

        return redirect()->route('news.index');
    }

    public function edit(NewsItem $newsItem)
    {
        return view('admin.news.edit', compact('newsItem'));
    }

    public function update(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date|before_or_equal:today',
        ]);

        if ($request->hasFile('image')) {
            if ($newsItem->image && Storage::exists('public/' . $newsItem->image)) {
                Storage::delete('public/' . $newsItem->image);
            }
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        $newsItem->update($validated);

        return redirect()->route('news.index');
    }

    public function destroy(NewsItem $newsItem)
    {
        if ($newsItem->image && Storage::exists('public/' . $newsItem->image)) {
            Storage::delete('public/' . $newsItem->image);
        }
        $newsItem->delete();

        return redirect()->route('news.index');
    }
}
