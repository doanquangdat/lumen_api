<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\InfomationBlogMail;

class BlogController extends Controller {
    
    /**
     * @function index
     */
    public function index() {
        $this->getList('Blog', 'author');
    }

    /**
     * @function getInfo
     * @params $id
     */
    public function getInfo($id) {
        $this->getDetail('Blog', $id, 'author');
    }

    /**
     * @funciton processForm
     * @params $request, $id
     */
    public function processForm(Request $request, $id = null) {
        $data = $request->all();
        $dataValidate = [
            'title' => 'required|unique:blogs,title,',
            'content' => 'required',
            'author_id' => 'required|numeric'
        ];
        if($id) {
            $dataValidate['view'] = 'numeric';
            $dataValidate['like'] = 'numeric';
            $this->validate($request, $dataValidate);
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $this->validate($request, $dataValidate);
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->saveForm('Blog', $data);
    }

    /**
     * @function drop
     * @params $id
     */
    public function drop($id) {
        $this->delete('Blog', $id);
    }

    /**
     * @function infoBlog
     * @params $id
     */
    public function infoBlog($id) {
        $data = DB::table('blogs')
        ->join('authors', 'blogs.author_id', '=', 'authors.id')
        ->where('blogs.id', $id)
        ->select('blogs.id', 'blogs.title', 'blogs.description', 'blogs.content', 'blogs.view', 'blogs.like', 'blogs.author_id', 'authors.name as author_name', 'authors.email as author_email')
        ->first();
        if($data != null) {
            $sendMail = Mail::to($data->author_email)->send(new InfomationBlogMail($data));
            if($sendMail == null) {
                $this->output('Send mail success', 200);
            } else {
                $this->output('Send mail fail', 500);
            }
        }else {
            $this->output('Not infomation blog', 404);
        }
    }

}