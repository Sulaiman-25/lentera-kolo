<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine if the user can delete the comment.
     */
    public function delete(User $user, Comment $comment): bool
    {
        // Hanya admin yang bisa menghapus
        return $user->is_admin;
    }

    /**
     * Determine if the user can view any comments.
     */
    public function viewAny(User $user): bool
    {
        // Hanya admin yang bisa melihat semua komentar
        return $user->is_admin;
    }

    /**
     * Determine if the user can restore the comment.
     */
    public function restore(User $user, Comment $comment): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine if the user can permanently delete the comment.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->is_admin;
    }
}
