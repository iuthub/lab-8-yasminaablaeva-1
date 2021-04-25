<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostController extends Controller
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    //explicitly asking Dependency Injector to give new instance of Post
    public function getIndex()
    {
        $posts = $this->post->getPosts();
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {
        $posts = $this->post->getPosts();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost($id)
    {
        $post = $this->post->getPost($id);
        return view('blog.post', ['post' => $post]);
    }

    public function getAdminCreate()
    {
        return view('admin.create');
    }

    public function getAdminEdit($id)
    {
        $post = $this->post->getPost($id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    public function postAdminCreate(Request $request): RedirectResponse
    {
        $this->validate($request, ['title' => 'required|min:5', 'content' => 'required|min:10']);
        $this->post->addPost($request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post created , Title is: '.$request->input('title'));
    }

    public function postAdminUpdate(Request $request): RedirectResponse
    {
        $this->validate($request, ['title' => 'required|min:5', 'content' => 'required|min:10']);
        $this->post->editPost($request->input('id'), $request->input('title'), $request->input('content'));
        return redirect()->route('admin.index')->with('info', 'Post edited , new Title is: ' . $request->input('title'));
    }
}
