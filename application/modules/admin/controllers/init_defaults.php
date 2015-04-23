<?php
if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class init_defaults extends MY_Controller {       

        function __construct() {

                parent::__construct();

                $this->load->library("Aauth");
                
                // header('Content-Type: application/json; charset=utf-8');
                // $this->output->enable_profiler(TRUE);
        }
        public function index(){
                // $this->aauth->create_perm('create_user');
                // $this->aauth->create_perm('edit_user');
                // $this->aauth->create_perm('remove_user');
                // $this->aauth->create_perm('add_device');
                // $this->aauth->create_perm('edit_device');
                // $this->aauth->create_perm('remove_device');
                // $this->aauth->create_perm('add_facility');
                // $this->aauth->create_perm('edit_facility');
                // $this->aauth->create_perm('remove_facility');
                // $this->aauth->create_perm('add_fcdrr');
                // $this->aauth->create_perm('edit_fcdrr');
                // $this->aauth->create_perm('remove_fcdrr');
                // $this->aauth->create_perm('generate_report');

                // $this->aauth->create_group('facility_users');
                // $this->aauth->create_group('county_level_users');
                // $this->aauth->create_group('partners');
                // $this->aauth->create_group('device_manufacturers');
                
        }
}