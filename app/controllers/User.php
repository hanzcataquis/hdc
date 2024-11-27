<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {
	
    public function __construct(){
        parent::__construct();
        $this->call->model('user_model');
    }
    public function read(){
        $data ['users'] = $this->user_model->read();
        $this->call->view('user/display', $data);
    }

    public function create(){
        if($this->form_validation->submitted()) {
            $last_name = $this->io->post('last_name');
            $first_name = $this->io->post('first_name');
            $email = $this->io->post('email');
            $gender = $this->io->post('gender');
            $address= $this->io->post('address');

            if($this->user_model->create($last_name, $first_name, $gender, $email, $address)) {
                set_flash_alert('success', 'Successfully inserted.');
            }
            else{
                set_flash_alert('danger', 'User not inserted.');
            }
        }
        $this->call->view('user/create');
    }

    public function update($id) {
        if($this->form_validation->submitted()) {
            $last_name = $this->io->post('last_name');
            $first_name = $this->io->post('first_name');
            $email = $this->io->post('email');
            $gender = $this->io->post('gender');
            $address= $this->io->post('address');

            if($this->user_model->update($id, $last_name, $first_name, $gender, $email, $address)){
                set_flash_alert('success', 'Successfully updated the user.');
            }
            else{
                set_flash_alert('danger', 'Failed to update user.');
                echo '<script>console.log("else run")</script>';
            }
        }
        $data['user'] = $this->user_model->singleUser($id);
        $this->call->view('user/update', $data);  
    }

    public function delete($id) {
        if($this->user_model->delete($id)){
            set_flash_alert('success', 'Successfully deleted.');
            redirect('/user/display');
        }
        else{
            set_flash_alert('danger', 'Failed to delete user.');
            redirect('/user/display');
        }
    }

}
?>