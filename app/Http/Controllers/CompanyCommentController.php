<?php

namespace App\Http\Controllers;

use App\Models\CompanyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyCommentController extends Controller
{
    public function index()
    {
        return CompanyComment::all();
    }
    public function show(int $companyId)
    {
        $comments = CompanyComment::where('company_id', $companyId)->with('user')->get();

        return response()->json($comments);
    }
    public function store(Request $request, int $companyId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        CompanyComment::create([
            'company_id' => $companyId,
            'user_id' => $userId,
            'comment' => $request->input('comment'),
        ]);

        return $this->show($companyId);
    }
}
