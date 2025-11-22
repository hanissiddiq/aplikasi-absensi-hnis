<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Counter;
use App\Models\Jabatan;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $title = 'Inventory';
        $search = request()->input('search');
        $inventories = Inventory::when($search, function ($query) use ($search) {
                                    $query->where('nama_barang', 'LIKE', '%' . $search . '%')
                                        ->orWhere('kode_barang', 'LIKE', '%' . $search . '%');
                                })
                                ->when(auth()->user()->is_admin !== 'admin', function ($query) {
                                    $query->where('jabatan_id', auth()->user()->jabatan_id);
                                })
                                ->orderBy('id', 'DESC')
                                ->paginate(10)
                                ->withQueryString();

        return view(auth()->user()->is_admin == 'admin' ? 'inventory.index' : 'inventory.indexUser', compact(
            'title',
            'inventories'
        ));
    }

    public function tambah()
    {
        $title = 'Inventory';
        $lokasi = Lokasi::orderBy('nama_lokasi')->get();
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();
        $counter = Counter::where('name', 'Inventory')->first();
        $counter->update(['counter' => $counter->counter + 1]);
        $next_number = str_pad($counter->counter, 6, '0', STR_PAD_LEFT);
        $kode_barang = $counter->text . '/' . $next_number;

        return view(auth()->user()->is_admin == 'admin' ? 'inventory.tambah' : 'inventory.tambahUser', compact(
            'title',
            'lokasi',
            'jabatan',
            'kode_barang',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required',
            'uom' => 'required',
            'desc' => 'nullable',
            'lokasi_id' => 'required',
            'jabatan_id' => 'required',
        ]);

        Inventory::create($validated);
        return redirect('/inventory')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Inventory';
        $lokasi = Lokasi::orderBy('nama_lokasi')->get();
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();
        $inventory = Inventory::find($id);

        return view(auth()->user()->is_admin == 'admin' ? 'inventory.edit' : 'inventory.editUser', compact(
            'title',
            'lokasi',
            'jabatan',
            'inventory',
        ));
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $validated = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required',
            'uom' => 'required',
            'desc' => 'nullable',
            'lokasi_id' => 'required',
            'jabatan_id' => 'required',
        ]);

        $inventory->update($validated);
        return redirect('/inventory')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect('/inventory')->with('success', 'Data Berhasil Dihapus');
    }

}
