<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use RajaOngkir;
use App\User;
use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{   
    public function __construct(){
        return $this->middleware('auth', ['except' => 'searchCity']);
    }

    public function index(){
        $provinsies = RajaOngkir::Provinsi()->all();
        $address = Address::where('origin',1)->first();
        return view('admin.address.index', compact('provinsies','address'));
    }
    
    public function searchCity($provId){
        $cities = RajaOngkir::Kota()->byProvinsi($provId)->get();
        return response($cities);
    }
    
    public function storeAdminOriginAddress(Request $request){
        $data = request()->validate([
            'address' => 'required|min:3',
            'phone' => 'required|min:10',
            'prov_id' => 'required',
            'provinsi' => 'required',
            'kab_id' => 'required',
            'kabupaten' => 'required',
            // 'kec_id' => 'required',
            // 'kecamatan' => 'required',
        ]);
        $city = RajaOngkir::Kota()->find($request->kab_id);
        if (Auth::user()->admin()){
            Address::create([
                'name' => 'ADMIN-ORIGIN',
                'penerima' => 'ADMIN',
                'address' => Purifier::clean($request->address),
                'prov_id' => $request->prov_id,
                'provinsi' => $request->provinsi,
                'kab_id' => $request->kab_id,
                'kabupaten' => $request->kabupaten,
                // 'kec_id' => 0,
                // 'kecamatan' => 'starter',
                'postal_code' => $city['postal_code'],
                'phone' => $request->phone,
                'user_id' => Auth::user()->id,
                'origin' => 1,
            ]);
            return back();
        }else {
            return view('errors.404');
        }
    }

    public function updateAdminOriginAddress(Request $request, $id){
        $data = request()->validate([
            'address' => 'required|min:3',
            'phone' => 'required|min:10',
            'prov_id' => 'required',
            'provinsi' => 'required',
            'kab_id' => 'required',
            'kabupaten' => 'required',
            // 'kec_id' => 'required',
            // 'kecamatan' => 'required',
        ]);
        $city = RajaOngkir::Kota()->find($request->kab_id);
        $address = Address::find($id);
        if (Auth::user()->admin()){
            $address->update([
                'address' => Purifier::clean($request->address),
                'prov_id' => $request->prov_id,
                'provinsi' => $request->provinsi,
                'kab_id' => $request->kab_id,
                'kabupaten' => $request->kabupaten,
                // 'kec_id' => 0,
                // 'kecamatan' => 'starter',
                'postal_code' => $city['postal_code'],
                'phone' => $request->phone,
                'user_id' => Auth::user()->id,
            ]);
            return back();
        }else {
            return view('errors.404');
        }
    }

    public function store(Request $request){
        $data = request()->validate([
            'name' => 'required|min:3',
            'penerima' => 'required|min:3',
            'address' => 'required|min:3',
            'phone' => 'required|min:10',
            'prov_id' => 'required',
            'provinsi' => 'required',
            'kab_id' => 'required',
            'kabupaten' => 'required',
            // 'kec_id' => 'required',
            // 'kecamatan' => 'required',
        ]);
        $city = RajaOngkir::Kota()->find($request->kab_id);
        Address::create([
            'name' => $request->name,
            'penerima' => $request->penerima,
            'address' => Purifier::clean($request->address),
            'prov_id' => $request->prov_id,
            'provinsi' => $request->provinsi,
            'kab_id' => $request->kab_id,
            'kabupaten' => $request->kabupaten,
            // 'kec_id' => 0,
            // 'kecamatan' => 'starter',
            'postal_code' => $city['postal_code'],
            'phone' => $request->phone,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function update(Request $request, $id){
        $data = request()->validate([
            'name_edit' => 'required|min:3',
            'penerima_edit' => 'required|min:3',
            'address_edit' => 'required|min:3',
            'phone_edit' => 'required|min:10',
            'prov_id_edit' => 'required',
            'provinsi_edit' => 'required',
            'kab_id_edit' => 'required',
            'kabupaten_edit' => 'required',
            // 'kec_id' => 'required',
            // 'kecamatan' => 'required',
        ]);
        $city = RajaOngkir::Kota()->find($request->kab_id);
        $address = Address::find($id);
        $address->update([
            'name' => $request->name_edit,
            'penerima' => $request->penerima_edit,
            'address' => Purifier::clean($request->address_edit),
            'prov_id' => $request->prov_id_edit,
            'provinsi' => $request->provinsi_edit,
            'kab_id' => $request->kab_id_edit,
            'kabupaten' => $request->kabupaten_edit,
            // 'kec_id' => 0,
            // 'kecamatan' => 'starter',
            'postal_code' => $city['postal_code'],
            'phone' => $request->phone_edit,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function delete($id){
        $address = Address::find($id);
        $address->delete();
        return back();
    }
    
}
