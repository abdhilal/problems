<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return $post ? response()->json($post, 200) : response()->json(['message' => 'Not Found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) return response()->json(['message' => 'Not Found'], 404);

        $post->update($request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]));

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) return response()->json(['message' => 'Not Found'], 404);

        $post->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
