<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{
    public function uploadFoto($dados)
    {
        $this->db->where('usuarios_id', $dados['usuarios_id']);
        $this->db->update('pessoas', $dados);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        
        return false;
    }
}