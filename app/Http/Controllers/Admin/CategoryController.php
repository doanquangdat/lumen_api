<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller {
    /**
     * @funtion index
     * @params: null
     */

    public function index() {
        $this->getList('Category');
    }

    /**
     * @function: getInfo
     * @params: id
     */
    public function getInfo($id) {
        $this->getDetail('Category', $id);
    }

    /**
     * @function: getInfo
     * @params: id
     */
    public function processFrom(Request $request, $id = null) {
        $data = $request->all();
        if($id) {
            $this->validate($request, [
                'name' => 'required|unique:categorys,name,'.$id
            ]);
            $data['id'] = $id;
            $data['updated_at'] = Carbon::now();
        } else {
            $this->validate($request, [
                'name' => 'required|unique:categorys,name,'
            ]);
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
        }

        $this->saveForm('Category', $data);
    }

    /**
     * @function: deleteCategory
     * @params: id
     */
    public function deleteCategory($id) {
        $this->delete('Category', $id);
    }
}