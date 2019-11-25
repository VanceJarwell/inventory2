<?php

namespace App\Http\Controllers;
use DB;
use App\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
    	$items = Items::all();
        $category = DB::table('category')->get();
        //return view('items.index', compact('category'));
    	return view('items.index', compact('category'))->with('items', $items);
    }
    public function create()
    {   
        $items = Items::all();
        $category = DB::table('category')->get();
        return view('items.index', compact('category'));
    }
    public function edit(Items $item){
        $category = DB::table('category')->get();
        return view('items.edit', compact('item','category'));
        
    }
    public function store()
    {
        request()->validate([
            'name' => 'required', 
            'quantity' => 'required',
            'category' => 'required',   
        ]);
        
    	$items= new Items;
    	$items->name = request()->name;
        $items->quantity = request()->quantity;
        $items->category = request()->category;
    	$items->save();
    	return $items;
    }
    public function update(Items $item)
    {
        $items->name = request()->name;
        $items->quantity = request()->quantity;
        $items->category = request()->category;
        $items->save();
        return redirect('/items');
    }
    public function destroy($id) {
      DB::delete('delete from items where id = ?',[$id]);
      return redirect('/items');
   }
}
