<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

use Illuminate\Support\Facades\Mail;
use \App\Mail\ContactMail;


class ContactController extends Controller
{
    
    public function sendMail($request){
        $data=$request->all();
        Mail::to($data["email"],$data["name"])->send(new ContactMail($data));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objContact = new Contact();
        //forma 1 relationship eloquent 
        $objUser =\Auth::user();
        $data = $objUser->contacts()->get()->all();
        return $data;  
        //forma 2 query Builder
        /*$objUser = new User(); 
        $user_id = \Auth::user()->id;
        $data = $objUser
        ->where("contacts.user_id",$user_id)
        ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ->select('contacts.*')
        ->get();*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.register')->with(["contact"=>null]);
    }

    public function saveImg($file){
        $name_file=time().'_'.$file->getClientOriginalName(); 
        if(\Storage::disk('contacts')->put($name_file,file_get_contents($file->getRealPath()))){
            return $name_file;
        }else{
            return false;
        }
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
            $valid = true;
            if(!empty($request->image)){         
                $name_file=$this->saveImg($request->image);
                if($name_file){
                   $objContact->image=$name_file;
                }else{
                   $valid=false;
                }
            }

            $objContact->name = $request->name;
            $objContact->age = $request->age;
            $objContact->email = $request->email;
            $objContact->phone = $request->phone;
            $objContact->identy = $request->identity;
            $objContact->user_id = \Auth::user()->id;
            if($valid){
                if($objContact->save()){
                    $this->sendMail($request);
                    \Session::flash("msj","Guardado con exito");
                    \Session::flash("error",false);
                    return redirect()->back();
                }
            }
            
        } catch (\Throwable $th) {
            \Session::flash("msj",$th->getMessage());
            \Session::flash("error",true);
            return redirect()->back();
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
        $objContact = new Contact();
        $data = $objContact->find($id);
        //$this->authorize('update',$data);
        return view('contact.register')->with(["contact"=>$data]);
        
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

    public function deleteImg($nombre_imagen){
        if(\Storage::disk('contacts')->delete($nombre_imagen)){
            return true;
        }else{
            return false;
        }
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
        $objContact = new Contact();
        $objContact = $objContact::find($id);
        if(!empty($objContact->image)){
            $this->deleteImg($objContact->image);
        }
        $valid = true;
        if(!empty($request->image)){         
            $name_file=$this->saveImg($request->image);
            if($name_file){
                $objContact->image=$name_file;
            }else{
                $valid=false;
            }
        }
        if($valid){
            $objContact->name = $request->name;
            $objContact->age = $request->age;
            $objContact->email = $request->email;
            $objContact->phone = $request->phone;
            $objContact->identy = $request->identity;
            if($objContact->save()){
                dd("si lo hizo");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $objContact = new Contact();
            $objContact = $objContact::find($id);
            if(!empty($objContact->image)){
                $this->deleteImg($objContact->image);
            }
            if($objContact->delete()){
                /*\Session::flash("msj","Eliminado con exito");
                \Session::flash("error",false);
                return redirect()->back();*/
                return response()->json( [ 'msg'=>"El usuario fue liminado con exito", 'cod'=>"success" ],200);
            }
        } catch (\Throwable $th) {
            /*\Session::flash("msj",$th->getMessage());
            \Session::flash("error",true);
            return redirect()->back();*/
            return response()->json( [ 'msg'=>$th->getMessage(), 'cod'=>"error" ],500);
        }
       
        
    }
}
