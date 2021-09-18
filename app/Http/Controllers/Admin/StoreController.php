<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function index()
    {
        $stores = \App\Store::paginate(10);

        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = \App\User::all(['id','name']);
        return view('admin.stores.create',compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $user->store()->create($data);

        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = $this->store->findOrFail($store);

        if($store->user_id == auth()->user()->id)
        {
            return view('admin.stores.edit', compact('store'));
        }
        else
        {
            flash('Essa loja não pertence a você!')->error();
            return redirect()->route('admin.stores.index');
        }
    }

    public function update(Request $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);
        $store->update($data);

        flash('Loja Atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = $this->store->findOrFail($store);

        if($store->user_id == auth()->user()->id)
        {
            $store->delete();
            flash('Loja removida com sucesso')->success();
            return redirect()->route('admin.stores.index');
        }
        else
        {
            flash('Essa loja não pertence a você!')->error();
            return redirect()->route('admin.stores.index');
        }
    }
}
