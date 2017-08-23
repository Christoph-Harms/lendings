<?php

namespace Lendings\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Lendings\Item;
use Lendings\Lending;
use Illuminate\Http\Request;
use Lendings\Repositories\LendingRepository;

class LendingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $req
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        /** @var Collection $lendings */
        $lendings = auth()->user()->lendings;
        $lendings->load('item');

        if ($req->wantsJson()) {
            return response()->json($lendings);
        }

        return view('lendings.index', [
            'lendings' => $lendings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param LendingRepository         $lendingRepo
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, LendingRepository $lendingRepo)
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

        $lending = $lendingRepo->lendOne($item, auth()->user());

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
