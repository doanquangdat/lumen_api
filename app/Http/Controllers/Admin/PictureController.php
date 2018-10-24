<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Picture;

class PictureController extends Controller
{
    /**
     * @function index
     */
    public function index() {
        $this->getList('Picture');
    }

    /**
     * @function processForm
     * @params $request, $id
     */
    public function processForm(Request $request, $id = null) {
        $data = $request->all();
        $validImage = ['jpg', 'jpeg', 'gif', 'png'];
        $url = 'public/uploads/picture';
        $this->validate($request, [
            'title' => 'required',
            'images' => 'required'
        ]);
        if($id) {
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        if($request->hasFile('images')) {
            $files = $request->file('images');
            $fileName = $this->upload($files, $validImage, $url);
            $data['images'] = $fileName;
        }
        $this->saveForm('Picture', $data);
    }
}
