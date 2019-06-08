<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Task extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('task_model');
        $this->isLoggedIn();
    }
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Task';
        $taskCount = $this->task_model->taskListingCount();

        $this->loadViews("dashboard", $this->global, $taskCount , NULL);
    }
    function taskListing()
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
            $count = $this->task_model->taskListingCount($searchText);
            $returns = $this->paginationCompress ( "taskListing/", $count, 10 );
            $data['taskRecords'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = 'CodeInsect : Task Listing';
            $this->loadViews("task/taskListing", $this->global, $data, NULL);
        }
    }

    function addTask()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('task_model');
            $data['users'] = $this->task_model->getImplementor();
            $data['sites'] = $this->task_model->getSite();
            $data['device'] = $this->task_model->getDevice();

            $this->global['pageTitle'] = 'CodeInsect : Add New Task';

            $this->loadViews("task/addTask", $this->global, $data, NULL);
        }
    }

    function addNewTask()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('taskName','Task Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('assignTo','Assign To','trim|required');
        $this->form_validation->set_rules('siteId','Task Site','trim|required');
        $this->form_validation->set_rules('deviceId','Device','trim|required');
        $this->form_validation->set_rules('description','Description','trim|required|max_length[255]');
        $this->form_validation->set_rules('status','Status','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->addTask();
        }
        else
        {

            $taskName = ucwords(strtolower($this->security->xss_clean($this->input->post('taskName'))));
            $assignTo = $this->input->post('assignTo');
            $siteId = $this->input->post('siteId');
            $deviceId = $this->input->post('deviceId');
            $description = ucwords(strtolower($this->security->xss_clean($this->input->post('description'))));
            $status = $this->input->post('status');

            $taskInfo = array('taskName'=>$taskName,'assignTo'=>$assignTo, 'siteId'=>$siteId, 'deviceId'=> $deviceId,
                'description'=>$description,'status'=>$status,'createdDtm'=>date('Y-m-d H:i:s'));

            $this->load->model('task_model');
            $result = $this->task_model->addNewTask($taskInfo);

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Task created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Task creation failed');
            }
            redirect('task/taskListing');
        }
    }

    function editOldTask($taskId = NULL)
    {
        if($taskId == null)
        {
            redirect('taskListing');
        }
        $this->load->model('task_model');
        $data['users'] = $this->task_model->getImplementor();
        $data['sites'] = $this->task_model->getSite();
        $data['device'] = $this->task_model->getDevice();
        $data['role'] = $this->roleText;
        $data['taskInfo'] = $this->task_model->getTaskInfo($taskId);

        $this->global['pageTitle'] = 'CodeInsect : Edit Task';

        $this->loadViews("task/editOldTask", $this->global, $data, NULL);
    }

    function editTask()
    {
        $this->load->library('form_validation');

        $taskId = $this->input->post('taskId');

        $this->form_validation->set_rules('taskName','Task Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('assignTo','Assign To','trim|required');
        $this->form_validation->set_rules('siteId','Address','trim|required');
        $this->form_validation->set_rules('deviceId','Device','trim|required');
        $this->form_validation->set_rules('description','Description','trim|required|max_length[255]');
        $this->form_validation->set_rules('status','Status','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->editOldTask($taskId);
        }
        else
        {

            $taskName = ucwords(strtolower($this->security->xss_clean($this->input->post('taskName'))));
            $assignTo = $this->input->post('assignTo');
            $siteId = $this->input->post('siteId');
            $deviceId = $this->input->post('deviceId');
            $description = ucwords(strtolower($this->security->xss_clean($this->input->post('description'))));
            $status = $this->input->post('status');


            if(empty($taskName))
            {
                $taskInfo = array('taskName'=>$taskName, 'assignTo'=>$assignTo,
                    'siteId'=>$siteId,'deviceId'=>$deviceId,'description'=>$description, 'status' =>$status,'updatedDtm'=>date('Y-m-d H:i:s'));
            }
            else
            {
                $taskInfo = array('taskName'=>$taskName,'assignTo'=>$assignTo, 'siteId'=>$siteId, 'deviceId'=> $deviceId,
                    'description'=>$description,'status' =>$status,'updatedDtm'=>date('Y-m-d H:i:s'));
            }

            $result = $this->task_model->editTask($taskInfo, $taskId);

            if($result == true)
            {
                $this->session->set_flashdata('success', 'Task updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Task updation failed');
            }
            if($this->roleText == 'Implementor'){
                redirect('assignedTask');
            }else{
                redirect('taskListing');
            }
        }
    }

    function deleteTask($taskId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $taskInfo = array('isDeleted'=>1, 'updatedDtm'=>date('Y-m-d H:i:s'));
            $result = $this->task_model->deleteTask($taskId, $taskInfo);
            if ($result > 0) { redirect('taskListing'); }
            else { echo(json_encode(array("Data Is Important!!!"))); }
        }
    }



    function taskHistory()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');
            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            $this->load->library('pagination');
            $count = $this->task_model->taskHistoryCount( $searchText, $fromDate, $toDate);
            $returns = $this->paginationCompress ( "task-history/", $count, 10, 3);
            $data['taskHistoryRecords'] = $this->task_model->taskHistory( $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            $this->global['pageTitle'] = 'CodeInsect : Task Login History';
            $this->loadViews("task/taskHistory", $this->global, $data, NULL);
        }
    }

    function completedTaskList(){

        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }else{
            $this->load->model('task_model');
            $data['taskRecords'] = $this->task_model->getCompletedTaskList();

            $this->global['pageTitle'] = 'CodeInsect :Completed Task Listing';

            $this->loadViews("task/completedTaskList", $this->global, $data, NULL);
        }
    }

    function assignedTask()
    {
        if($this->isImplementor() == TRUE)
        {
            $roleId = $this->vendorId;
            $data['role'] = $this->roleText;
            $this->load->model('task_model');
            $data['assignedRecords'] = $this->task_model->assignedTaskList($roleId);
            $this->global['pageTitle'] = 'CodeInsect :Assigned Task Listing';
            $this->loadViews("task/assignedTask", $this->global, $data, NULL);
        }
    }

    function exportEtpCsv(){
        $searchText = $this->input->post('searchText');
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $data['searchText'] = $searchText;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $this->load->library('pagination');
        $count = $this->task_model->taskHistoryCount( $searchText, $fromDate, $toDate);
        $returns = $this->paginationCompress ( "csvGenerator/", $count, 10, 3);
        $data = $this->task_model->taskListing($searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"generatedcsv".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
       fputcsv($handle, array("Task No","Task Name","Description","Implementor Name","Site Address","Device Name","Status"));
        foreach ($data as $datas) {
            if($datas->status == 1){
                $status = 'Completed';
            }else{
                $status = 'Processing';
            }
            $array = array($datas->taskId,$datas->taskName,$datas->description,$datas->UserName,$datas->SiteAddress,$datas->deviceName,$status);
            fputcsv($handle, $array);
        }
        fclose($handle);
        exit;
    }

    function pdf()
    {
        $this->load->helper('pdf_helper');
        $this->load->model('task_model');
        $searchText = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchText;
        $this->load->library('pagination');
        $count = $this->task_model->taskListingCount($searchText);
        $returns = $this->paginationCompress ( "taskListing/", $count, 10 );
        $data['pdfData'] = $this->task_model->taskListing($searchText, $returns["page"], $returns["segment"]);
        //$data['pdfData'] = $this->task_model->sendMail();
        $this->global['pageTitle'] = 'CodeInsect : PDF Report';
        $this->loadViews('task/pdfreport',$this->global, $data);
    }



    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

