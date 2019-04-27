<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
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
        return view('contact.register')->with(["error"=>false,"msj"=>""]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //ContactRequest
    public function store(Request $request)
    {   
        try {
            $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required'
            ]);
            $objContact = new Contact();
            $objContact->name = $request->name;
            $objContact->age = $request->age;
            $objContact->email = $request->email;
            $objContact->phone = $request->phone;
            $objContact->identy = $request->identity;
            $objContact->user_id = \Auth::user()->id;
            if($objContact->save()){
                return view("contact.register")->with(["error"=>false,"msj"=>"Guardado con exito"]);
            }
        } catch (\Throwable $th) {
            return view("contact.register")->with(["error"=>true,"msj"=>$th->getMessage()]);
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
        //
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
