<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Traits\deleteTraits;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use deleteTraits;
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->user->latest()->paginate(5);
        return view('admin.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->latest()->get();
        return view('admin.User.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->nameAdd,
                'email' => $request->emailAdd,
                'password' => Hash::make($request->passwordAdd),
            ]);
            $user->roles()->attach($request->roleUserAdd);
            DB::commit();
            return redirect()->route('UserController.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = $this->role->latest()->get();
        $user = $this->user->find($id);
        return view('admin.User.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->find($id);
            if ($request->passwordAdd == null) {
                $user->update([
                    'name' => $request->nameAdd,
                    'email' => $request->emailAdd,
                ]);
            } else {
                $user->update([
                    'name' => $request->nameAdd,
                    'email' => $request->emailAdd,
                    'password' => Hash::make($request->passwordAdd),
                ]);
            }
            $user->roles()->sync($request->roleUserAdd);
            DB::commit();
            return redirect()->route('UserController.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' Line: ' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->roles()->detach();
        return $this->DeleteTraits($this->user, $id);
    }
}
