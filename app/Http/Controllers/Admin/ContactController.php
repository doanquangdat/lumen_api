<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use App\Mail\ContactMail;

class ContactController extends Controller {

    /**
     * @function index
     */
    public function index() {
        $this->getList('Contact');
    }

    /**
     * @function processForm
     * @params $request, $id
     */
    public function processForm(Request $request, $id = null) {
        $data = $request->all();
        $dataValidate = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'content' => 'required'
        ];
        if($id) {
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->validate($request, $dataValidate);
        $this->saveForm('Contact', $data);
    }

    public function mailContact($id) {
       $infoContact = Contact::findOrFail($id);
       if($infoContact) {
            $mail = Mail::to($infoContact->email)->send(new ContactMail($infoContact));
            if($mail == null) {
                $this->output('Sendmail success', 200);
            } else {    
                $this->output('Sendmail fail', 401);
            }
       } else {
           $this->output('Contact is not existend', 404);
       }
    }
}