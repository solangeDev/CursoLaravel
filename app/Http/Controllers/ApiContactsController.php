<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ApiContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            \Log::info('Guardad con exito');
            $objContact = new Contact();
            $objContact->name = $request->name;
            $objContact->age = $request->age;
            $objContact->email = $request->email;
            $objContact->phone = $request->phone;
            $objContact->identy = $request->identy;
            $objContact->user_id = $request->user_id;;
            if($objContact->save()){
                return response()->json( [ 'msg'=>"success", 'data' => $objContact ],200); 
            }
            
        } catch (\Throwable $ex) {
            \Log::error('Error al guardar el contacto LINE: '.$ex->getLine().' FILE: '.$ex->getFile().'Message: '.$ex->getMessage());
            return response()->json( [ 'msg' => 'Error al crear contacto'],500);   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        try {
            $objContact = new Contact();
            $data = $objContact::where("id",$id)->get();
            if(!empty($data)){
                return response()->json( [ 'msg'=>"success", 'data' => $data ],200); 
            } 
         } catch (Exception $ex) {
               \Log::error('Error al consultar el contacto LINE: '.$ex->getLine().' FILE: '.$ex->getFile().'Message: '.$ex->getMessage());
              return response()->json( [ 'msg' => 'Error al crear contacto'],500);   
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
