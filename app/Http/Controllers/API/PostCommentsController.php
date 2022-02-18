<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = [];
        $comments = Comment::all();

        if ($comments) {
            $res['comments'] = $comments;
            $res['message'] = 'Success';
        }
        return response($res, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'content' => 'required|max:255',
            'author_name' => 'required',
            'post_id' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $comment = Comment::create($data);
        if ($comment) {
            $res = [
                'post' => new Comment($data),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'content' => 'required|max:255',
                'author_name' => 'required',
                'post_id' => 'required|int'
            ]);

            if ($validator->fails()) {
                return response(['error' => $validator->errors(), 'Validation Error']);
            }

            $updated = $comment->update($data);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentIsDeleted = false;
        $comment = Comment::find($id);

        if (!empty($comment)) {
            $commentIsDeleted = Comment::find($id)->delete();
        }

        if ($commentIsDeleted) {
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
}
