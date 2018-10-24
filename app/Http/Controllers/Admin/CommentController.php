<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\CommentMail;

class CommentController extends Controller {

    /**
     * @function index
     */
    public function index() {
        $this->getList('Comment', ['tour', 'blog']);
    }

    /**
     * @function showDetail
     * @params $id
     */
    public function showDetail($id) {
        $this->getDetail('Comment', $id, ['tour', 'blog']);
    }

    /**
     * @function processForm
     * @params $request, $id
     */
    public function processForm(Request $request, $id = null) {
        $data = $request->all();
        $dataValdate = [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required'
        ];
        if($id) {
            $data['id'] = $id;
            $data['status'] = 1;
            $data['updated_at'] = Carbon::now();
        } else {
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->validate($request, $dataValdate);
        $this->saveForm('Comment', $data);
    }

    /**
     * @function mailConfim
     * @params $id
     */
    public function mailConfim($id) {
        $infoComment = Comment::with(['tour', 'blog'])->where('id', $id)->first();
        if(is_null($infoComment)) {
            $this->output('Comment does not existend', 404);
        } else {
            $mail = Mail::to($infoComment->email)->send(new CommentMail($infoComment));
            (is_null($mail)) ? $this->output('Mail confirm send success', 200) : $this->output('Mail confirm send fail', 200);
        }
    }
}