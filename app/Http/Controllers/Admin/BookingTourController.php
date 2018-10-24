<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BookingTour;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\AccuracyTourMail;

class BookingTourController extends Controller {
    
    /**
     * @function index
     */
    public function index() {
        $this->getList('BookingTour', 'tour');
    }

    /**
     * @function getInfo
     */
    public function getInfo($id) {
        $this->getDetail('BookingTour', $id, 'tour');
    }

    /**
     * @function editBookingTour
     */
    public function procBookingTour(Request $request, $id) {
        $data = $request->all();
        $dataValidate = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'tour_id' => 'required'
        ];
        if($id) {
            $dataValidate['status'] = 'required|numeric';
            $this->validate($request, $dataValidate);
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $this->validate($request, $dataValidate);
            $data['status'] = 0;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->saveForm('BookingTour', $data);
    }

    public function sendMail($id) {
        $infoTour = BookingTour::find($id);
        if($infoTour != null) {
           $send_mail = Mail::to($infoTour->email)->send(new AccuracyTourMail($infoTour));
           if($send_mail === null) {
                $this->output('Send mail success', 200);    
           } else {
                $this->output('Semail mail fail', 500);
           }
        } else {
            $this->output('Not infomation booking tour', 404);
        }
    }
}