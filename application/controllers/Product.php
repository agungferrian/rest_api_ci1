<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Product extends Rest_Controller
    {
        function __construct($config = 'rest') 
        {
            parent::__construct($config);
            $this->load->database();
        }
        
        // menampilkan data di tbl product
        function index_get()
        {
            $id = $this->get('id_product');
            if ($id == '') {
                $toko = $this->db->get('product')->result();
            } else {
                $this->db->where('id_product', $id);
                $toko = $this->db->get('product')->result();
            }
            $this->response($toko, 200);
        }

        function index_post()
        {
            $data = array(
                'id_product' => $this->post('id_product'),
                'id_shops' => $this->post('id_shops'),
                'name_product' => $this->post('name_product'),
                'stock' => $this->post('stock'),
                'img_product' => $this->post('img_product'),
                'description' => $this->post('description') 

            );
            $insert = $this->db->insert('product', $data);
            if ($insert) {
                $response = $this->response(array($data, 'message' => 'data berhasil di tambah', 'status' => 'success', 'code' => '200'));
            } else {
                $response = $this->response(array('status' => 'fail', 502));
            }
        }

        function index_put() 
        {
            $id = $this->put('id_product');
            $data = array(
                'id_product' => $this->put('id_product'),
                'id_shops' => $this->put('id_shops'),
                'name_product' => $this->put('name_product'),
                'stock' => $this->put('stock'),
                'img_product' => $this->put('img_product'),
                'description' => $this->put('description')

            );
            $this->db->where('id_product', $id);
            $update = $this->db->update('product', $data);
            
            if ($update) {
                $response = $this->response($data, 200);
            } else {
                $response = $this->response(array('status' => 'fail', 502));
            }
        }

        function index_delete() 
        {
            $id = $this->delete('id_product');
            $this->db->where('id_product', $id);
            $delete = $this->db->delete('product');
            if ($delete) {
                $response = $this->response(array('message' => 'data berhasil di delete', 'status' => 'success', 'code' => '200'));
            } else {
                $response = $this->response(array('status' => 'error', 502));
            }
        }
    }

?>