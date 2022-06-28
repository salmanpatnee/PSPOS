<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::latest()->paginate(10);
        // return new UserCollection($users);

        //Prepare Response for DataTable Plugin.

        return DataTables::of(User::query())
            ->addColumn('role', function (User $user) {
                return $user->getRoleNames()->first();
            })->addColumn('status', function (User $user) {
                return $user->status ? 'Active' : 'Inactive';
            })->addColumn('joining_date', function (User $user) {
                return $user->created_at->format('Y m d');
            })->addColumn('last_login', function (User $user) {
                return ($user->last_login_at) ? Carbon::parse($user->last_login_at)->diffForHumans() : '';
            })->addColumn('action', function (User $user) {
                $userData = new UserResource($user);
                $userData = json_encode($userData);
                $buttons =  "<button data-user='" . $userData . "' class='btn btn-info btn-sm edit-btn' data-toggle='tooltip' data-placement='left'  data-original-title='Update'><i class='fa fa-pencil'
                aria-hidden='true'></i></button> <button data-userId='" . $user->id . "' type='button'
                
                class='btn btn-danger btn-sm delete-btn' data-toggle='tooltip'
                data-placement='right'  data-original-title='Delete'><i
                    class='fa fa-trash-o' aria-hidden='true'></i></button>";
                return $buttons;
            })->rawColumns(['action'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name'      => 'required|string|min:3|max:255',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|min:6|max:255|confirmed',
            'status'    => 'required|string',
            'role'      => 'required|string|exists:roles,name'
        ]);

        $role = array_pop($attributes);

        $user = User::create($attributes);

        $user->assignRole($role);

        return new UserResource($user);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $attributes = request()->validate([
            'name'      => 'required|string|min:3|max:255',
            'email'     => ['required', 'email', 'min:3', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'  => 'sometimes|required|min:6|max:255|confirmed',
            'status'    => 'required|string',
            'role'      => 'required|string|exists:roles,name'
        ]);

        $role = array_pop($attributes);

        $user = User::find($user->id);
        $user->update($attributes);


        // $user->update($attributes);

        $user->roles()->detach();

        $user->assignRole($role);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
