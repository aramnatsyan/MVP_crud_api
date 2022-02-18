<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhoneItemResource;
use App\Models\PhoneItem;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->post_comments = $post->comments;
        }
        return response(['posts' => $posts, 'message' => 'Success'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'link' => 'required',
            'author_name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $post = Post::create($data);
        if ($post) {
            $res = [
                'post' => new Post($data),
                'message' => 'Created successfully'
            ];
        } else {
            $res = [
                'error' => 'Something went wrong',
                'message' => 'Failed'
            ];
        }

        return response($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        if ($post) {

            $data = $request->all();

            $validator = Validator::make($data, [
                'title' => 'required|max:255',
                'link' => 'required',
                'author_name' => 'required|max:255',
                'votes' => 'boolean',
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors(), 'Validation Error']);
            }

            if ($data['votes']) {
                $data['votes'] = $post->votes + 1;
            }

            $updated = $post->update($data);

            if ($updated) {
                $res = [
                    'message' => 'Updated successfully'
                ];
            } else {
                $res = [
                    'message' => 'failed'
                ];
            }

            return response($res, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postIsDeleted = false;
        $post = Post::find($id);

        if (!empty($post)) {
            $postIsDeleted = Post::find($id)->delete();
        }

        if ($postIsDeleted) {
            $res = [
                'message' => 'Deleted successfully'
            ];
        } else {
            $res = [
                'message' => 'Failed'
            ];
        }

        return response($res, 200);
    }

    /**
     * Action for vote posts
     * @param Request $request
     * @param $id
     */
    public function vote($id)
    {
        $res = [];
        $status = 404;
        $postIsVoted = false;
        $post = Post::find($id);

        if($post) {

            $data['votes'] = $post->votes + 1;

            $postIsVoted = $post->update($data);

            if ($postIsVoted) {
                $res = [
                    'message' => 'Updated successfully'
                ];
                $status = 200;
            } else {
                $res = [
                    'message' => 'failed'
                ];
                $status = 500;
            }
        }
        else {
            $res = [
                'message' => 'Post not Found'
            ];
            $status = 404;
        }

        return response($res, $status);
    }
}
