<?php

namespace App\Http\Controllers\Admin;

use App\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->all();

        if($request->hasFile('logo'))
        {
            $data['logo'] = $request->file('logo')->store('stores', 'public');
        }

        auth()->user()->store()->create($data);

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
        $data = $request->all();
        $store = $this->store::find($store);

        if($request->hasFile('logo'))
        {
            if(Storage::disk('public')->exists($store->logo))
            {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $request->file('logo')->store('stores', 'public');
        }

        $store->update($data);

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
