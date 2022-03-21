<?php

/**
 * @property Todo_model $todo_model
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 */
class Todo extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('todo_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['todos'] = $this->todo_model->get_all_todo();
        $data['title'] = 'Toutes mes tâches';

        $this->load->view('templates/header', $data);
        $this->load->view('todo/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['action'] = base_url().'create';
        $data['title'] = 'Créer une nouvelle tâche';

        $this->form_validation->set_rules('label', 'Label', 'required');

        $form_is_valid = $this->form_validation->run();

        if ($form_is_valid === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('todo/edit');
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'label' => $this->input->post('label'),
                'completed' => (bool)$this->input->post('completed')
            );

            $this->todo_model->set_todo($data);
            redirect(base_url());
        }
    }

    public function edit($todo_id = 0)
    {
        $data['todo'] = $this->todo_model->get_todo((int)$todo_id);
        if (empty($data['todo'])) {
            show_404();
        }

        $data['action'] = 'edit/' . $todo_id;

        $data['title'] = 'Modifier la tâche';

        $this->form_validation->set_rules('label', 'Label', 'required');

        $form_is_valid = $this->form_validation->run();

        if ($form_is_valid === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('todo/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array_merge($data['todo'], array(
                'label' => $this->input->post('label'),
                'completed' => (bool)$this->input->post('completed')
            ));

            $this->todo_model->set_todo($data);
            redirect(base_url());
        }

    }

    public function toggle_completed($todo_id = 0)
    {
        $todo = $this->todo_model->get_todo((int)$todo_id);

        if (empty($todo)) {
            show_404();
        }

        $todo['completed'] = !$todo['completed'];
        $this->todo_model->set_todo($todo);
        redirect(base_url());
    }

    public function delete_all_completed()
    {
        $this->todo_model->delete_all_completed();
        redirect(base_url());
    }
}
