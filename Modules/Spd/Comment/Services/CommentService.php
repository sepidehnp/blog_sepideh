<?php

namespace Spd\Comment\Services;

use Spd\Comment\Models\Comment;
use Spd\Role\Models\Permission;

class CommentService
{
    public function store($request)
    {
        return Comment::query()->create([
            'user_id' => auth()->id(),
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'body' => $request->body,
            'status' => $this->setStatus(),
        ]);
    }

    private function setStatus()
    {
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)) {
            return Comment::STATUS_ACTIVE;
        }

        return Comment::STATUS_NEW;
    } 
}
