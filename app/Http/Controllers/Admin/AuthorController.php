<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthorController extends Controller {

    /**
     * @funciton index
     */
    public function index() {
        $this->getList('Author');
    }

    public function getInfo($id) {
        $this->getDetail('Author', $id);
    }

    /**
     * @function processForm
     */
    public function processForm(Request $request, $id = null) {
        $data = $request->all();
        $dataValidate = [
            'name' => 'required|unique:authors,name,',
            'email' => 'required|unique:authors,email,',
            'phone' => 'required|numeric',
            'address' => 'required'
        ];
        if($id) {
            $dataValidate['name'] = 'required|unique:authors,name,'.$id;
            $dataValidate['email'] = 'required|unique:authors,email,'.$id;
            $this->validate($request, $dataValidate);
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $this->validate($request, $dataValidate);
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }
        $this->saveForm('Author', $data);
    }

    public function drop($id) {
        $this->delete('Author', $id);
    }

}