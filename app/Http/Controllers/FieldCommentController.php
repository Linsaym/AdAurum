<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\FieldCommentRequest;
use App\Models\FieldComment;

class FieldCommentController extends Controller
{
    public function store(FieldCommentRequest $request)
    {
        $comment = FieldComment::create($request->validated());

        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ], 201);
    }

    public function index($companyId, $fieldId)
    {
        $comments = FieldComment::where('company_id', $companyId)
            ->where('field_id', $fieldId)
            ->get();

        return response()->json($comments);
    }

    public function update(CompanyRequest $request, $id)
    {
        $comment = FieldComment::findOrFail($id);
        $comment->update($request->validated());

        return response()->json([
            'message' => 'Comment updated successfully.',
            'comment' => $comment,
        ]);
    }

    public function destroy($id)
    {
        $comment = FieldComment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully.',
        ]);
    }
}
