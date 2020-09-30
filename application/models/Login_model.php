<?php
/*
- Author: Francisco Geneuto
- Url: https://geneuto.com
- Email: geneuto@gmail.com
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function getById($id)
    {
        $this->db->select('usuarios.*, pessoas.*, usuarios.email, pessoas.nome_pessoas');
        $this->db->from('usuarios');
        $this->db->join('pessoas', 'usuarios.idUsuarios = pessoas.usuarios_id', 'RIGHT');
        $this->db->where('usuarios.idUsuarios', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    // Checa as credenciais de acesso do usuário
    public function check_credentials($email)
    {
        $this->db->select('usuarios.*, pessoas.*, usuarios.email, pessoas.nome_pessoas');
        $this->db->from('usuarios');
        $this->db->join('pessoas', 'usuarios.idUsuarios = pessoas.usuarios_id', 'LEFT');
        $this->db->where('usuarios.email', $email);
        $this->db->where('usuarios.situacao', 1);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    // Lista todos os usuarios do banco
    public function list_contas()
    {
        $this->db->select('usuarios.*, pessoas.*, usuarios.email, pessoas.nome_pessoas');
        $this->db->from('usuarios');
        $this->db->join('pessoas', 'usuarios.idUsuarios = pessoas.usuarios_id', 'LEFT');
        return $this->db->get()->result();
    }

    // Altera a senha do usuário pegando a sessão logada
    public function alterarSenha($senha)
    {
        $this->db->set('senha', $senha['senha']);
        $this->db->where('idUsuarios',  $this->session->userdata('id'));
        $this->db->update('usuarios');

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }

    public function check_hash($hash)
    {
        $this->db->select('*');
        $this->db->from('recuperacao_senha');
        $this->db->where('recuperacao_senha.hash_recuperacao', $hash);
        $this->db->where('recuperacao_senha.status_recuperacao', 1);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    function ver($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }

    function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }

        return false;
    }

    function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }

        return false;
    }

    function count($table)
    {
        return $this->db->count_all($table);
    }
}
