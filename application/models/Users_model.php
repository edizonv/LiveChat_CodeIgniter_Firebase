<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public $usersTable = "store_users";

    function loginValidation($data) {
        $loginValidation = $this->db
            ->select('user_uname AS uname, user_pw AS upass')
            ->from($this->usersTable)
            ->where('user_uname', $data['userId'])
            ->where('user_status', 1)
            ->get()
            ->row();
        return $loginValidation;
    }

    function loginWithGoogle($data) {
        $ifExists = $this->db
            ->where('user_email', $data['user_email'])
            ->where('user_status', 1)
            ->get($this->usersTable)
            ->num_rows();
        if ($ifExists == 0) {
            $data = [
                'user_name'         => $data['user_name'],
                'user_email'        => $data['user_email'],
                'user_uname'        => $data['user_uname'],
                'user_google_login' => 1,
                'user_status'       => 1
            ];
            $loginWithGoogle = $this->db->insert($this->usersTable, $data);
            return $loginWithGoogle;
        } else {
            echo "emailExist";
            exit;
        }
    }

    function signUp($data) {
        $ifExists = $this->db
            ->where('user_email', $data['email'])
            ->where('user_status', 1)
            ->get($this->usersTable)
            ->num_rows();
        if ($ifExists == 0) {
            $newEmail = explode('@',  $data['email']);
            $newName = $newEmail[0].'_'.mt_rand();
            $newPass = $data['newPass'];

            $this->load->library('email');
            $this->email->from('edizon.villegas@transcosmos.com.ph', 'Store');
            $this->email->to($data['email']);
            $this->email->subject('Email Activation');
            $this->email->message('Hi'. $data['fname'] . ' ' . $data['lname'] . '! <br><br>Here is your Username : '.$newName.' <br>Click the link to activate your account. <a href="https://buyandsellstore.000webhostapp.com/users/activate/'.urlencode(substr($newPass, -10) ).'">https://buyandsellstore.000webhostapp.com/users/activate/'.urlencode(substr($newPass, -10) ).'</a>');
            $this->email->set_mailtype('html');
            $this->email->send();
            
            $data = [
                'user_name'     => $data['fname'] . ' ' . $data['lname'],
                'user_email'    => $data['email'],
                'user_uname'    => $data['fname'].$data['lname'],
                'user_uname'    => $newName,
                'user_pw'       => $newPass,
                'user_status'   => 0
            ];

            $signUp = $this->db->insert($this->usersTable, $data);
            return $signUp;
        }
    }

    function activate() {
        $data = [
            'user_status' => 1
        ];
        $this->db->like('user_pw', urldecode($this->uri->segment('3') ) );
        $activate = $this->db->update($this->usersTable, $data);
    }

}