<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TestCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestCasePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TestCase');
    }

    public function view(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('View:TestCase');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TestCase');
    }

    public function update(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('Update:TestCase');
    }

    public function delete(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('Delete:TestCase');
    }

    public function restore(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('Restore:TestCase');
    }

    public function forceDelete(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('ForceDelete:TestCase');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TestCase');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TestCase');
    }

    public function replicate(AuthUser $authUser, TestCase $testCase): bool
    {
        return $authUser->can('Replicate:TestCase');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TestCase');
    }

}