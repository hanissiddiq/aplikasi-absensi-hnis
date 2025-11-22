<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Role';
        $search = request()->input('search');

        $roles = Role::when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', '%'.$search.'%');
        })
        ->orderBy('name', 'ASC')
        ->paginate(10)
        ->withQueryString();

        return view('role.index', compact(
            'title',
            'roles',
        ));
    }

    public function tambah()
    {
        $title = 'Role';

        return view('role.tambah', compact(
            'title',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        Role::create($validated);
        return redirect('/role')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Role';
        $role = Role::find($id);

        return view('role.edit', compact(
            'title',
            'role',
        ));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);

        $role->update($validated);
        return redirect('/role')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect('/role')->with('success', 'Data Berhasil Dihapus');
    }
}
