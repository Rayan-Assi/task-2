<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Pest\Laravel\json;
use function Pest\Laravel\post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        /* return view("posts.index")->with("posts".$posts); */
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageName = "";
        $imageNames = [];
        if ($request->hasFile("image")) {
            $files = $request->file("image");
            foreach ($files as $file) {
                $imageName = $file->getClientOriginalName() . "-" . time() . "." . $file->getClientOriginalExtension();
                $file->move(public_path("/images/posts"), $imageName);
                $imageNames[] = $imageName;
            }
        }
        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "image" => json_encode($imageNames)

        ]);

        return redirect()->route("posts.index");
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $posts  = Post::findOrFail($id);
        /* او 
         $posts  = Post::where($id)->get();*/
        return view('posts.show', compact('posts'));
    } 
    /*  public function show(Post $post)
    {
       return view("posts.show",compact('posts'));
    } */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Post::findOrFail($id);
        return view('posts.edit', compact('posts'));
    }
    /* 
     public function edit($post)
    {
        return view('posts.edit', compact('posts'));
    }
     */
    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $imageNames = json_decode($post->image);
        if ($imageNames) {
            foreach ($imageNames as $oldImage) {
                if (File::exists(public_path('/images/posts/' . $oldImage))) {
                    File::delete(public_path('/images/posts/' . $oldImage));
                }
            }
            $imageNames = [];
        }
        if ($request->hasFile('image')) {
            $files = $request->file("image");
            foreach ($files as $file) {
                $imageName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('/images/posts'), $imageName);
                $imageNames[] = $imageName;
            }
        }
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => json_encode($imageNames)
        ]);
        return redirect()->route('posts.index');
    }
/* 
public function update(Request $request, Post $post)
{ حالة صورة وحدة 
if($request->hasFile('image'))
{$imageName = $file->getClientOriginalName() . "-" . time() . "." . $file->getClientOriginalExtension();
$request->move(public_path("/images/posts"), $imageName);

}else{
$image=$post->image;
}
$post->update([
"title"=>$request->title,
'description' => $request->description,
'image' => $imageName 
]);
   return redirect()->route('posts.index');
}

*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post_id = Post::findOrFail($id);
        /* $oldImage = $post_id->image;
 */
        $imageNames = json_decode($post_id->image);

        if ($post_id->delete()) {
            if ($imageNames) {
                foreach ($imageNames as $oldImage) {
                    if (File::exists(public_path('/images/posts/' . $oldImage))) {
                        File::delete(public_path('/images/posts/' . $oldImage));
                    }
                }
            }
            return redirect()->route("posts.index");
        }
    }
}
