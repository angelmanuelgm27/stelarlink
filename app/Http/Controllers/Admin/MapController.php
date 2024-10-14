<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coordinates;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class MapController extends Controller
{
    //

    public function index(){
       
        $coordinates = Coordinates::all();
        return view('admin.map', compact('coordinates'));
    }

    public function store(Request $request){

        // $url = explode(' ', $request->input('map_iframe'))[1];
        $url = explode(' ', $request->input('map_iframe'));
        $reemplace = array('src=', 'https://','"', 'www.');
        $iframe_url = str_replace($reemplace, '', $url);

        $coordinates = new Coordinates();
        $coordinates->latitude = str_replace(',', '',$request->input('map_latitude'));
        $coordinates->longitude = str_replace(',', '', $request->input('map_longitude'));
        // $coordinates->iframe = $iframe_url;
        $coordinates->iframe = $iframe_url[0];
        $coordinates->name = $request->input('map_name');
        $coordinates->save();
        Alert::success('Nueva coordenada agregada', '');
        return redirect()->back();
    }

    public function delete($id){
        try {
            $coordinates = Coordinates::find($id);
            $coordinates->delete();
            Alert::success('Coordenada eliminada', '');
           return redirect()->back();
        } catch (\Exception $e) {
           Alert::error('Hubo al eliminar coordenada', $e->getMessage());
           return redirect()->back();
        }
    }
}
