<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\FieldCommentRequest;
use App\Models\CompanyField;
use App\Models\FieldComment;
use Illuminate\Support\Facades\Auth;

class FieldCommentController extends Controller
{
    public function getFieldsWithComments(int $companyId)
    {
        return CompanyField::with(['comments' => function ($query) use ($companyId) {
            $query->where('company_id', $companyId)->with('user');
        }])->get();
    }

    public function store(FieldCommentRequest $request, int $companyId, int $fieldId)
    {
        $userId = Auth::id();

        $comment = FieldComment::create([
            'comment' => $request->comment,
            'company_id' => $companyId,
            'field_id' => $fieldId,
            'user_id' => $userId
        ]);

        return $this->show($companyId, $fieldId);
    }

    public function show(int $companyId, int $fieldId)
    {
        $comments = FieldComment::where('company_id', $companyId)
            ->where('field_id', $fieldId)->with('user')
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
