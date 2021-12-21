<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Imports\SubmenuImport;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicle::where('user_id', auth()->user()->id)->first();
        $vehicle['menu'] = Menu::where('vehicle_id', $vehicle->id)->get();
        return view('vehicle.menu.menu', compact('vehicle'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $vehicle_menu, Request $request)
    {
        $menu = $vehicle_menu;
        if ($request->has('filter')) {
            $vehicle = Vehicle::find($request->vehicle_id);
            $submenu = Submenu::where('vehicle_id', $vehicle->id);
            $menu['submenu'] = $submenu->where('menu_id', $request->menu_id);
            $value = $request->filter;
            if ($value == 'scooter') {
                $submenu = $submenu->where('type', 'scooter');
            }
            if ($value == 'bike') {
                $submenu = $submenu->where('type', 'bike');
            }
            if ($value == 'excel') {
                $submenu = $submenu->where('is_excel', '1');
            }
            if ($value == 'panel') {
                $submenu = $submenu->where('is_excel', '0');
            }
            if ($value == 'all') {
                $submenu = $submenu;
            }
            $menu['submenu'] = $submenu->get();
            $view = view('vehicle.submenu.display_submenu', compact('menu'))->render();
            return response()->json(['html' => $view, 'success' => true]);
        } else {
            $vehicle = Vehicle::where('user_id', auth()->user()->id)->first();
            $submenu = Submenu::where('vehicle_id', $vehicle->id);
            $menu['submenu'] = $submenu->where('menu_id', $menu->id);
            $menu['submenu'] = $submenu->get();
            return view('vehicle.submenu.submenu', compact('menu'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
