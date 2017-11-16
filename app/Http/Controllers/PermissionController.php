<?php

namespace App\Http\Controllers;

use App\Repositories\{PermissionRepository, RoleRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PermissionController
 *
 * @package App\Http\Controllers
 */
class PermissionController extends Controller
{
    private $roleRepository;        /** @var RoleRepository         $roleRepository       */
    private $permissionRepository;  /** @var PermissionRepository   $permissionRepository */ 

    /**
     * PermissionController constructor 
     *
     * @param  PermissionRepository  $permissionRepository  Abstraction layer between model and controller
     * @param  RoleRepository        $roleRepository        Abstraction layer between model and controller
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository) 
    {
        $this->middleware('auth');

        $this->permissionRepository = $permissionRepository; 
        $this->roleRepository       = $roleRepository;
    }

    /**
     * Index view for the ACL management console. 
     *
     * @return View
     */
    public function index(): View 
    {
        $paginateLimit = 25; 

        return view('acl.index', [
            'roles'       => $this->roleRepository->paginate($paginateLimit),
            'permissions' => $this->permissionRepository->paginate($paginateLimit),
        ]); 
    }

    /**
     * Delete a permission or role out off the storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(): RedirectResponse 
    {
        return redirect()->route('acl.index');
    }
}
