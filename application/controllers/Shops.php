<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Shops extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data di tbl shops
    function index_get() {
        $id = $this->get('id_shops');
        if ($id == '') {
            $toko = $this->db->get('shops')->result();
        } else {
            $this->db->where('id_shops', $id);
            $toko = $this->db->get('shops')->result();
        }
        $this->response($toko, 200);
    }

    //Masukan function selanjutnya disini
    function index_post() {
        $data = array(
            'id_shops'          => $this->post('id_shops'),
            'name'              => $this->post('name'),
            'city'              => $this->post('city'),
            'provinsi'          => $this->post('provinsi'),
            'logo'              => $this->post('logo'));
        $insert = $this->db->insert('shops', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_put()
    {
        $id = $this->put('id_shops');
        $data = array(
            'id_shops' =>$this->put('id_shops'),
            'name' =>$this->put('name'),
            'city' => $this->put('city'),
            'provinsi' => $this->put('provinsi'),
            'logo' => $this->put('logo')
        );
        
        $this->db->where('id_shops', $id);
        $update = $this->db->update('shops',$data);

        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // fungsi hapus data di tbl shops 
    function index_delete() 
    {
        $id = $this->delete('id_shops');
        $this->db->where('id_shops', $id);
        $delete = $this->db->delete('shops');
        if ($delete) {
            $this->response(array('status' => 'success', 200));
        } else{
            $this->response(array('status' => 'fail', 502));    
        }
    }

//     public function index()
//     {
//         $url = "http://127.0.0.1/rest_api_ci/index.php/Product";
//         $get_url = file_get_contents("url");
//         $data = json_encode($get_url);

//         $data_array = array( 'datalist'=> $data);
//         $this->load->view('json_list', $data_array);
//     }
// }

?>
