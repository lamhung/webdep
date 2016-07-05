<?php
class User_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('users');
    }
    
    public function default_value()
    {
        return array(
            'id' => NUll,
            'fullname' => '',
            'username' => '',
            'groups' => '0',
            'image_' => base_url('assets/backend/img/icons/no_avatar_256x256.png'),
            'phone' => '',
            'email' => '',
            'address' => '',
            'gender' => 1,
            'birthday' => '',
            'status' => 1
        );
    }
    public function convert_data($data = array())
    {
        $data['image_'] = base_url('assets/backend/img/icons/no_avatar_256x256.png');
        if(isset($data['image']) && file_exists(UPLOADPATH . 'user/thumbnail/'.$data['image'])){
             $data['image_'] = base_url('uploads/user/thumbnail/'.$data['image']);
        }
        $data['gender_'] = $this->lang->line('user_gender_'.$data['gender']);
        $data['status_'] = $this->lang->line('user_status_'.$data['status']);
        $data['groups_'] = $this->lang->line('user_group_'.$data['groups']);
        if(isset($data['create_at'])) {
            $data['create_at_'] = date('d-m-Y H:i', $data['create_at']);
        }
        return $data;
    }
    
    public function change_password($old_password = '', $new_password = '')
    {
        $result = array('success' => FALSE, 'msg' => '');
        
        $user_login = $this->session->userdata('user_login');
        $user = $this->get_by(array('id' => $user_login['id']));
        if($user['password'] != md5(md5($old_password))) //$user['password'] != md5(md5($old_password))
        {
            $result['msg'] = $this->lang->line('auth_password_not_available');
        }
        else
        {
            $user['password'] = md5(md5($new_password)); //md5(md5($new_password));
            $user['change_password'] = 0;
            $this->update($user);
            $user_login['change_pass'] = 0;
            $this->session->set_userdata('user_login', $user_login);
            $result['success'] = TRUE;
        }
        
        return $result;
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
    }
    
    /******************* BACKEND *********************/
    
    public function backend_is_login() {
        $user_login = $this->session->userdata('user_login');
        $this->session->set_userdata('current_uri', $this->uri->uri_string());
        if(!isset($user_login['id']))
        {
            redirect(base_url('acp/login'));
        }
        elseif($user_login['is_admin'] != 1)
        {
            redirect(base_url('deny'));
        }
        elseif($user_login['change_pass'] == 1)
        {
            redirect(base_url('acp/change_password'));
        }
        else
        {
            $this->session->set_userdata('current_uri', '');
        }
        return true;
    }

    public function backend_login($input) {
        $result = array('success' => FALSE, 'msg' => '');
        $user = $this->get_by(array('username' => $input['u']));
        if(!$user)
        {
            $result['msg'] = $this->lang->line('user_not_exist');
        }
        else{
            if($user['login_fail'] >= 5)
            {
                $user['status'] = 0;
                $this->update($user);
                $result['msg'] = $this->lang->line('user_has_been_locked');
            }
            else if($user['groups'] != 1) {
                $result['msg'] = $this->lang->line('user_has_been_deny');
            }
            else if($user['status'] == 0) {
                $result['msg'] = $this->lang->line('user_has_been_locked');
            }
            else if($user['password'] != md5(md5($input['p']))) {
                $user['login_fail'] += 1;
                $this->update($user);
                $result['msg'] = $this->lang->line('auth_password_not_available');
            }
            else {
                $session = array(
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'groups' => $user['groups'],
                    'is_admin' => 1,
                    'change_pass' => $user['change_password']
                );
                $this->session->set_userdata('user_login', $session);
                $result['success'] = TRUE;
                $user['login_fail'] = 0;
                $this->update($user);
            }
        }
        return $result;
    }
    
   
}