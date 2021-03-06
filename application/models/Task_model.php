<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model{

    function taskListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskName  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status !=', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function taskListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskName  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.isDeleted', null);
        $this->db->order_by('BaseTbl.taskId', 'DESC');

        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    function taskHistoryCount( $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();

        return $query->num_rows();
    }


    function taskHistory( $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.taskName  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.taskId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;

        $result = $query->result();
        return $result;
    }

    function addNewTask($taskInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_task', $taskInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getTaskInfo($taskId)
    {
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        $this->db->where('BaseTbl.taskId', $taskId);
        $query = $this->db->get();

        return $query->row();
    }

    function editTask($taskInfo, $taskId)
    {
        $this->db->where('taskId', $taskId);
        $this->db->update('tbl_task', $taskInfo);
        return TRUE;
    }

    function deleteTask($taskId, $taskInfo)
    {
        $this->db->where('taskId', $taskId);
        $this->db->update('tbl_task', $taskInfo);

        return $this->db->affected_rows();
    }

    function getTaskInfoById($taskId)
    {
        $this->db->select('*');
        $this->db->from('tbl_task');
        $this->db->where('isDeleted', 0);
        $this->db->where('taskId', $taskId);
        $query = $this->db->get();
        return $query->row();
    }

    function getImplementor(){
        $this->db->select('userId,name');
        $this->db->from('tbl_users');
        $this->db->where('userId !=', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function getSite(){
        $this->db->select('*');
        $this->db->from('tbl_sites');
        $query = $this->db->get();
        return $query->result();
    }

    function getDevice(){
        $this->db->select('*');
        $this->db->from('iot_devices');
        $query = $this->db->get();
        return $query->result();
    }

    function getCompletedTaskList(){

        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        $this->db->where('BaseTbl.status =', 1);
        $query = $this->db->get();

        return $query->result();
    }

    function assignedTaskList($roleId){
        $this->db->select('BaseTbl.*, User.name as UserName,Site.address as SiteAddress,Device.deviceName as deviceName');
        $this->db->from('tbl_task as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.assignTo','left');
        $this->db->join('tbl_sites as Site', 'Site.siteId = BaseTbl.siteId','left');
        $this->db->join('iot_devices as Device', 'Device.deviceId = BaseTbl.deviceId','left');
        $this->db->where('BaseTbl.assignTo =',$roleId);
        $this->db->order_by('BaseTbl.taskId', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

}

