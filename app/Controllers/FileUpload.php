<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class FileUpload extends Controller
{
    use ResponseTrait;

    function upload() { 
        helper(['form', 'url']);

        $input = $this->validate([
            'file' => ['uploaded[file]']
        ]);
    
        if (!$input) {
            return $this
                ->setResponseFormat('json')
                ->respond([
                    'success' => false,
                    'message' => 'Choose a valid file'
                ]);
        } else {
            $img = $this->request->getFile('file');
            $img->move(WRITEPATH . 'uploads');
            
            return $this
                ->setResponseFormat('json')
                ->respond([
                    'success' => true,
                    'message' => 'File ' . $img->getName() . ' uploaded successful to writable/uploads folder',
                ]);
        }
    }

}