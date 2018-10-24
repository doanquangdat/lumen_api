<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
const MODEL_PATH = '\App\Models\\';

class Controller extends BaseController
{ 
    /**
     * @function output
     * @params $data, $statusCode
     */
    public function output($data, $statusCode) {
        return response()->json($data, $statusCode)->send(); die;
    }

    /**
     * @function getList
     * @params $model, $joinTable
     */
    public function getList($modelName, $joinTable = null) {
        $model = MODEL_PATH.$modelName;
        $data;
        if($joinTable) {
            $data = $model::with($joinTable)->get();
        } else {
            $data = $model::all();
        }
        $this->output($data, 200);
    }

    /**
     * @funciton getDetail
     * @params $model, $id, $joinTable
     */
    public function getDetail($modelName, $id, $joinTable = null) { 
        $model = MODEL_PATH.$modelName;
        $data;
        if($joinTable) {
            $data = $model::with($joinTable)->where('id', $id)->first();
        } else {
            $data = $model::findOrFail($id);
        }
        $this->output($data, 200);
    }

    /**
     * @function saveForm
     * @params $modelName, $data
     */
    public function saveForm($modelName, $data) {
        $model = MODEL_PATH.$modelName;
        if(isset($data['id'])) {
            $id = $data['id'];
            $dataModel =  $model::find($id);
            if($dataModel) {
                $edit = $model::where('id', $id)->update($data);
                ($edit) ? $this->output('Edit success', 200) : $this->output('Edit fail', 401);
            } else {
                $this->output($modelName.' is not existend', 404);
            }
        } else {
            $create = $model::create($data);
            ($create) ? $this->output('Create success', 200) : $this->output('Create fail', 401);
        }
    }

    /**
     * @function delete
     * @params $modelName, $id
     */
    public function delete($modelName, $id) {
        $model = MODEL_PATH.$modelName;
        $delete = $model::destroy($id);
        if($delete) {
            $this->output('Delete success', 200);
        } else {
            $this->output('Delete fail', 401);
        }
    }

    /**
     * @function upload0
     * @params $file: Infomation file upload
     * @params $validFile: Valid file format
     * @params $url: File path to save
     * @return json data nameImage or false;
     */
    public function upload($files, $validFile = null, $url) {
        $upload = false;
        foreach($files as $file) {
            $fileName = time().'_'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            if($validFile) {
                $check = in_array($extension, $validFile);
                if($check) {
                    $destinationPath = storage_path($url);
                    $file->move($destinationPath, $fileName);
                    $nameImage[] = $fileName;
                    $upload = true;
                } else {
                    $this->output('Invalid file format. Please check again.', 401);
                    die;
                }
            } else {
                $destinationPath = storage_path($url);
                $file->move($destinationPath, $fileName);
                $nameImage[] = $fileName;
                $upload = true;
            }
        }
        return json_encode($nameImage);
    }
}
