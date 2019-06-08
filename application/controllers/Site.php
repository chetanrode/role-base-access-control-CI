<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Site extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Sites';

        $siteCount = $this->site_model->siteListingCount();

        $this->loadViews("dashboard", $this->global, $siteCount , NULL);
    }
    function siteListing()
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

            $count = $this->site_model->siteListingCount($searchText);

            $returns = $this->paginationCompress ( "siteListing/", $count, 10 );

            $data['siteRecords'] = $this->site_model->siteListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Site Listing';

            $this->loadViews("site/list", $this->global, $data, NULL);
        }
    }

    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('site_model');

            $this->global['pageTitle'] = 'CodeInsect : Add New site';

            $this->loadViews("site/addSite", $this->global, array(), NULL);
        }
    }

    function checkEmailExists()
    {
        $siteId = $this->input->post("siteId");
        $email = $this->input->post("email");

        if(empty($siteId)){
            $result = $this->site_model->checkEmailExists($email);
        } else {
            $result = $this->site_model->checkEmailExists($email, $siteId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    function addNewsite()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('address','Address','trim|required|max_length[255]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[128]');
            $this->form_validation->set_rules('district','District','required|max_length[128]');
            $this->form_validation->set_rules('state','State','trim|required|max_length[128]');
            $this->form_validation->set_rules('pincode','Pincode','trim|required|numeric');
            $this->form_validation->set_rules('contact','Contact','required|min_length[10]');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $address = ucwords(strtolower($this->security->xss_clean($this->input->post('address'))));
                $city = ucwords(strtolower($this->security->xss_clean($this->input->post('city'))));
                $district = ucwords(strtolower($this->security->xss_clean($this->input->post('district'))));
                $state = ucwords(strtolower($this->security->xss_clean($this->input->post('state'))));
                $pincode = $this->security->xss_clean($this->input->post('pincode'));
                $contact = $this->security->xss_clean($this->input->post('contact'));

                $siteInfo = array('address'=>$address, 'city'=>$city, 'district'=>$district, 'state'=> $state,
                    'pincode'=>$pincode, 'contact'=>$contact);

                $this->load->model('site_model');
                $result = $this->site_model->addNewsite($siteInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New site created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Site creation failed');
                }

                redirect('siteListing');
            }
        }
    }

    function editOldSite($siteId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($siteId == null)
            {
                redirect('siteListing');
            }

            $data['siteInfo'] = $this->site_model->getSiteInfo($siteId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Site';

            $this->loadViews("site/editOldSite", $this->global, $data, NULL);
        }
    }



    function editSite()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');

            $siteId = $this->input->post('siteId');

            $this->form_validation->set_rules('address','Address','trim|required|max_length[255]');
            $this->form_validation->set_rules('city','City','trim|required|max_length[128]');
            $this->form_validation->set_rules('district','District','required|max_length[128]');
            $this->form_validation->set_rules('state','State','trim|required|max_length[128]');
            $this->form_validation->set_rules('pincode','Pincode','trim|required|numeric');
            $this->form_validation->set_rules('contact','Contact','required|min_length[10]');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldSite($siteId);
            }
            else
            {
                $address = ucwords(strtolower($this->security->xss_clean($this->input->post('address'))));
                $city = ucwords(strtolower($this->security->xss_clean($this->input->post('city'))));
                $district = ucwords(strtolower($this->security->xss_clean($this->input->post('district'))));
                $state = ucwords(strtolower($this->security->xss_clean($this->input->post('state'))));
                $pincode = $this->security->xss_clean($this->input->post('pincode'));
                $contact = $this->security->xss_clean($this->input->post('contact'));

                $siteInfo = array();

                if(empty($password))
                {
                    $siteInfo = array('address'=>$address, 'city'=>$city, 'district'=>$district,
                        'state'=>$state,'pincode'=>$pincode,'contact'=>$contact, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $siteInfo = array('address'=>$address, 'city'=>$city, 'district'=>$district,
                        'state'=>$state,'pincode'=>$pincode,'contact'=>$contact, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }

                $result = $this->site_model->editsite($siteInfo, $siteId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Site Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Site Updation failed');
                }

                redirect('siteListing');
            }
        }
    }

    function deleteSite($siteId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $siteInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $result = $this->site_model->deleteSite($siteId, $siteInfo);
            if ($result > 0) { redirect('siteListing'); }
            else { echo(json_encode(array("Data Is Important!!!"))); }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
