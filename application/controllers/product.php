<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller {

    function __construct()
    {
        parent::__construct();


    }

    public function index(){
        $this->load->view('product');
        //$this->load->model('product_model');

    }

    public function add_newProduct(){
        $this->load->model('product_model');

        $this->form_validation->set_rules('item_name','Item Name','required');
        $this->form_validation->set_rules('item_price','Item Price','required');

        if($this->form_validation->run() == False){
            $data['error_message']='error';
            $this->load->view('product',$data);
            return;
        }

        $item_name =$this->input->post('item_name');
        $item_price =$this->input->post('item_price');
        ;

        $result=$this->product_model->get_lastId();
        $last_id =(int)$result[0]['item_id'];

        $data=array(
            'item_id'=>++$last_id,
            'item_name'=>$item_name,
            'item_price'=>$item_price
        );

        $this->product_model->add_newProduct($data);


    }
    public function set_product(){
        if (!empty($_POST['remove'])) {
            $this->update();
        }

        if (!empty($_POST['update'])) {
            $this->remove();
        }
    }

    public function remove(){
        $this->load->model('product_model');
        $item_id = $this->input->post('item_no');
        $this->product_model->remove_product($item_id);
    }

    public function update(){
        $this->load->model('product_model');

        $this->form_validation->set_rules('item_name','Item Name','required');
        $this->form_validation->set_rules('item_price','Item Price','required');

        if($this->form_validation->run() == False){
            $data['error_message']='error';
            $this->load->view('product',$data);
            return;
        }

        $item_id = $this->input->post('item_no');
        $item_name =$this->input->post('item_name');
        $item_price =$this->input->post('item_price');
        ;


        $data=array(
            'item_id'=>$item_id,
            'item_name'=>$item_name,
            'item_price'=>$item_price
        );

        $this->product_model->update_product($data);
    }

}
