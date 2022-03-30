<?php

namespace Darius\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Darius\Common\Responses\AjaxResponses;
use Darius\Media\Services\MediaFileService;
use Darius\RolePermissions\Repositories\RoleRepo;
use Darius\User\Http\Requests\AddRoleRequest;
use Darius\User\Http\Requests\UpdateUserRequest;
use Darius\User\Models\User;
use Darius\User\Repositories\UserRepo;

class UserController extends Controller
{

    protected $userRepo;
    protected $roleRepo;

    public function __construct(UserRepo $userRepo, RoleRepo $roleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $this->authorize('index', User::class);
        $users = $this->userRepo->paginate();
        $roles = $this->roleRepo->all();
        return view('User::Admin.index', compact('users', 'roles'));
    }

    public function edit($userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);
        $roles = $this->roleRepo->all();
        return view('User::Admin.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $this->authorize('edit', User::class);
        $user = $this->userRepo->findById($userId);

        if($request->hasFile('image')) {
            $request->request->add(['image_id' => MediaFileService::upload($request->file('image'))->id]);
            if($user->banner) $user->banner->delete();
        }else {
            $request->request->add(['image_id' => $user->image_id]);
        }

        $this->userRepo->update($userId, $request);
        newFeedback();
        return redirect()->back();
    }

    public function destroy($userId)
    {
        $user = $this->userRepo->findById($userId);
        $user->delete();

        return AjaxResponses::SuccessResponse();
    }

    public function manualVerify($userId)
    {
        $this->authorize('manualVerify', User::class);
        $user = $this->userRepo->findById($userId);
        $user->markEmailAsVerified();
        return AjaxResponses::SuccessResponse();
    }

    public function addRole(AddRoleRequest $request, User $user)
    {
        $this->authorize('addRole', User::class);
        $user->assignRole($request->role);
        newFeedback('موفقیت آمیز', " نقش کاربری {$user->name} به کاربر {$request->role} داده شد.", 'success');
        return back();
    }

    public function removeRole($userId, $role)
    {
        $this->authorize('removeRole', User::class);
        $user = $this->userRepo->findById($userId);
        $user->removeRole($role);
        return AjaxResponses::SuccessResponse();

    }
}
