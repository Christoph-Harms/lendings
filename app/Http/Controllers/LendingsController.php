<?php

namespace Lendings\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Lendings\Item;
use Lendings\Lending;
use Illuminate\Http\Request;

class LendingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var Collection $lendings */
        $lendings = auth()->user()->lendings;
        $lendings->load('item');



        return view('lendings.index', [
            'lendings' => $lendings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required|exists:items,id'
        ]);

        /** @var Item $item */
        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $item = Item::find(request('item_id'));

        if (!$item->available) {
            return response()->json('This item is not available.')
                ->setStatusCode(423);
        }

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        $lending = Lending::create([
            'user_id' => auth()->user()->id,
            'item_id' => request('item_id'),
        ]);

        /** @noinspection PhpDynamicAsStaticMethodCallInspection */
        Item::find(request('item_id'))->update([
            'available' => false,
        ]);

        return response()->json($lending)
            ->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Lendings\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function show(Lending $lending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Lendings\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Lendings\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lending $lending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Lendings\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lending $lending)
    {
        //
    }
}
