<?php

namespace App\Http\Controllers\Admin;

use App\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    private $store;

    public function __construct(Store $store)
    {
        $this->middleware('user.has.store')->only(['create','store']);
        $this->store = $store;
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request)
    {
        auth()->user()->store()->create($request->all());

        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = $this->store->findOrFail($store);

        if($store->user_id !== auth()->user()->id)
        {
            flash('Essa loja não pertence a você!')->warning();
            return redirect()->route('admin.stores.index');
        }
        
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $this->store::find($store)->update($request->all());

        flash('Loja Atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = $this->store->findOrFail($store);

        if($store->user_id !== auth()->user()->id)
        {
            flash('Essa loja não pertence a você!')->warning();
            return redirect()->route('admin.stores.index');
        }
        
        $store->delete();

        flash('Loja removida com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
