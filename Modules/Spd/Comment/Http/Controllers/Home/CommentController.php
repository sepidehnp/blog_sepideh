<?php

namespace Spd\Comment\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Spd\Comment\Http\Requests\CommentRequest;
use Spd\Comment\Services\CommentService;
use Spd\Share\Repositories\ShareRepo;

class CommentController extends Controller
{
    public function store(CommentRequest $request, CommentService $commentService)
    {
        $commentService->store($request);

        ShareRepo::successMessage('نظر شما پس از تایید در سایت نمایش داده میشود');
        return back();
    }
}
