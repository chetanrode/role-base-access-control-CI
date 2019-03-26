<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Device_model extends CI_Model{

    function deviceListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.createdDtm, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }
    function deviceListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('iot_devices as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.deviceId  LIKE '%".$searchText."%'
                            OR  BaseTbl.deviceName  LIKE '%".$searchText."%'
                            OR  BaseTbl.deviceType  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.deviceId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function addNewDevice($deviceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('iot_devices', $deviceInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function editDevice($deviceInfo, $deviceId)
    {
        $this->db->where('deviceId', $deviceId);
        $this->db->update('iot_devices', $deviceInfo);

        return TRUE;
    }

    function getDeviceTypes()
    {
        $this->db->select('typeId, deviceType');
        $this->db->from('device_type');
        $this->db->where('typeId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }


    function deleteDevice($deviceId, $deviceInfo)
    {
        $this->db->where('deviceId', $deviceId);
        $this->db->update('iot_devices', $deviceInfo);

        return $this->db->affected_rows();
    }


    function getDeviceInfo($deviceId)
    {
        $this->db->select('*');
        $this->db->from('iot_devices');
        $this->db->where('isDeleted', 0);
        $this->db->where('deviceId', $deviceId);
        $query = $this->db->get();

        return $query->row();
    }
}

