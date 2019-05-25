<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Auth;
use PDF;

class PdfController extends Controller
{
    function donwloadPdf(){
        $contacts=new Contact();
        $user= Auth::user();
        $pepe=$user->contacts()->get()->all();
        $pdf = PDF::loadView('contact.contactpdf',compact('pepe'));
        return $pdf->download('contacts.pdf');
    }
}
