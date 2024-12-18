<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class EcoForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua postingan dari database (termasuk relasi, jika ada)
        $posts = Post::with(['buyer', 'comment'])->latest()->get();
        // dd($posts);

        // Kirim data postingan ke view
        return view('ecoforumhome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buyer_id = session('buyer')->id;

        // Validate the request data
        $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'like' => 'nullable|numeric'
        ]);

        // Add buyer_id to validated data
        $validated['buyer_id'] = $buyer_id;

        // If an image is provided, store it manually in the public/images folder
        if ($request->hasFile('image')) {
            // Get the uploaded image
            $image = file_get_contents($validated['image']->getRealPath());
        }
        Post::create([
            'buyer_id' => $buyer_id,
            'content' => $validated['content'],
            'image' => $image,
            'like' => 0
        ]);

        return redirect()->route('ecoforum.index')->with('success', 'Post Created Successfully');
    }



    public function toggleLike(Request $request, $id)
    {
        $buyer_id = session('buyer') ? session('buyer')->id : null;

        if (!$buyer_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $post = Post::findOrFail($id);

        $like = $post->likes()->where('buyer_id', $buyer_id)->first();

        if ($like) {
            $like->delete();
            $post->decrement('like');

            return response()->json(['status' => 'unliked', 'likes_count' => $post->likes]);
        } else {
            $post->likes()->create(['buyer_id' => $buyer_id]);
            $post->increment('like');

            return response()->json(['status' => 'liked', 'likes_count' => $post->likes]);
        }
    }

    public function getLikeCount($postId)
    {
        $likeCount = Post::findOrFail($postId)->likes()->count();
        return response()->json(['likeCount' => $likeCount]);
    }

    public function storeReply(Request $request, $postId)
    {
        // Check if it's a comment fetch request
        if ($request->method() === 'POST' && !$request->has('content')) {
            $comments = Comment::where('post_id', $postId)
                ->with('buyer')
                ->get()
                ->map(function ($comment) {
                    return [
                        'buyer_name' => $comment->buyer->name,
                        'comment' => $comment->comment
                    ];
                });

            return response()->json($comments);
        }

        // Store new reply
        $validatedData = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id'
        ]);

        $reply = new Comment();
        $reply->post_id = $postId;
        $reply->buyer_id = session('buyer')->id;
        $reply->comment = $validatedData['content'];
        $reply->save();

        // Fetch updated comments
        $comments = Comment::where('post_id', $postId)
            ->with('buyer')
            ->get()
            ->map(function ($comment) {
                return [
                    'buyer_name' => $comment->buyer->name,
                    'comment' => $comment->comment
                ];
            });

        return response()->json($comments);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
