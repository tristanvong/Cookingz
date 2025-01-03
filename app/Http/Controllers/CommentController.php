<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\NewsItem;

class CommentController extends Controller
{
    public function store(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['news_item_id'] = $newsItem->id;

        Comment::create($validated);
        return redirect()->route('news.show', $newsItem->id)->with('success', 'Comment added successfully');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $comment->delete();
        return back();
    }
}