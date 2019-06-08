<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Device extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('device_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Device';
        $deviceCount = $this->task_model->deviceListingCount();

        $this->loadViews("device/deviceList", $this->global, $deviceCount , NULL);
    }
    function deviceListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->device_model->deviceListingCount($searchText);

            $returns = $this->paginationCompress ( "deviceListing/", $count, 10 );

            $data['deviceRecords'] = $this->device_model->deviceListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Device Listing';

            $this->loadViews("device/deviceList", $this->global, $data, NULL);
        }
    }

    function addDevice()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('device_model');
            $data['deviceTypes'] = $this->device_model->getDeviceTypes();
            $this->global['pageTitle'] = 'CodeInsect : Add New Device Type';
            $this->loadViews("device/addDevice", $this->global,$data, NULL);
        }
    }


    function addNewDevice()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');


            $this->form_validation->set_rules('deviceType','Device Type','trim|required');
            $this->form_validation->set_rules('deviceName','Device Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('stock','Stock','required|numeric');

            if($this->form_validation->run() == FALSE)
            {

                $this->addDevice();
            }
            else
            {
               //
                //    print_r($this->input->post());exit;
                $deviceType = ucwords(strtolower($this->security->xss_clean($this->input->post('deviceType'))));
                $deviceName = ucwords(strtolower($this->security->xss_clean($this->input->post('deviceName'))));
                $stock = $this->input->post('stock');

                $deviceInfo = array('deviceType'=>$deviceType, 'deviceName'=>$deviceName, 'stock'=>$stock);

                $this->load->model('device_model');
                $result = $this->device_model->addNewDevice($deviceInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Device Entry created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Device Entry creation failed');
                }

                redirect('deviceListing');
            }
        }
    }



    function editOldDevice($deviceId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($deviceId == null)
            {
                redirect('deviceListing');
            }

            $data['deviceInfo'] = $this->device_model->getDeviceInfo($deviceId);
            $data['deviceTypes'] = $this->device_model->getDeviceTypes();

            $this->global['pageTitle'] = 'CodeInsect : Update Device';

            $this->loadViews("device/updateDevice", $this->global, $data, NULL);
        }
    }

    function editDevice()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $deviceId = $this->input->post('deviceId');

            $this->form_validation->set_rules('deviceType','Device Type','required');
            $this->form_validation->set_rules('deviceName','Device Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('stock','Stock','required|max_length[128]');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldDevice($deviceId);
            }
            else
            {
                $deviceType = $this->input->post('deviceType');
                $deviceName = ucwords(strtolower($this->security->xss_clean($this->input->post('deviceName'))));
                $stock = ucwords(strtolower($this->security->xss_clean($this->input->post('stock'))));

                $deviceInfo = array('deviceType'=>$deviceType, 'deviceName'=>$deviceName, 'stock'=>$stock,'updatedDtm'=>date('Y-m-d H:i:s'));

                $result = $this->device_model->editDevice($deviceInfo, $deviceId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Device Updated successfully');
                    redirect('deviceListing');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Device Updation failed');
                }


            }
        }
    }

    function deleteDevice($deviceId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $this->load->model('device_model');
            $this->load->library('form_validation');
            $deviceInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $result = $this->device_model->deleteDevice($deviceId, $deviceInfo);
            if ($result == 1) { redirect('deviceListing'); }
            else { redirect('deviceListing'); }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
