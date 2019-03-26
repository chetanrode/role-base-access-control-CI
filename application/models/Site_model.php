<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model{

    function siteListingCount($searchText = '')
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
    function siteListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_sites as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.pincode  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.isDeleted', 0);
        // $this->db->order_by('BaseTbl.siteId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function addNewSite($siteInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_sites', $siteInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getSiteInfo($siteId)
    {
        $this->db->select('*');
        $this->db->from('tbl_sites');
        $this->db->where('siteId', $siteId);
        $query = $this->db->get();
        return $query->row();
    }


    function editSite($siteInfo, $siteId)
    {
        $this->db->where('siteId', $siteId);
        $this->db->update('tbl_sites', $siteInfo);

        return TRUE;
    }


    function deleteSite($siteId, $siteInfo)
    {
        $this->db->where('siteId', $siteId);
        $this->db->update('tbl_sites', $siteInfo);

        return $this->db->affected_rows();
    }


    function getSiteInfoById($siteId)
    {
        $this->db->select('*');
        $this->db->from('tbl_sites');
        $this->db->where('isDeleted', 0);
        $this->db->where('siteId', $siteId);
        $query = $this->db->get();

        return $query->row();
    }

    function getSiteById($siteId){
        $this->db->select('address');
        $this->db->from('tbl_sites');
        $this->db->where('siteId',$siteId);
        $query = $this->db->get();
        return $query->result();
    }
}

