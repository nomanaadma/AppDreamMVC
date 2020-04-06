<?php
  class Users extends Controller {

    
    public function __construct(){
      $this->userModel = $this->model('User');
    }
    
    public function register(){
      $rules = ['name' => 'required', 'email' => 'required|email', 'password' => 'required|min:8', 'confirm_password' => 'required|min:8'];
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password'])
        ];

        $validate = Validator::data($data, $rules);

        $data['errors'] = $validate;

        // Check email
        if($this->userModel->findUserByEmail($data['email'])){
          $data['errors']['email'][] = 'Email is already taken';
        }

        if(count($data['errors']) == 0) {
          // Validated

          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
        }
          // Load view with errors
          $this->view('users/register', $data);
      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      $rules = ['email' => 'required|email', 'password' => 'required'];
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password'])
        ];

        $validate = Validator::data($data, $rules);
        $data['errors'] = $validate;

        // Make sure errors are empty
        if(count($data['errors']) == 0) {
          // Validated

          // Check for user/email
          if($this->userModel->findUserByEmail($data['email'])){
            // User found
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            
            // Check and set logged in user
            if($loggedInUser){
              // Create Session
              $this->createUserSession($loggedInUser);
            } else {
              $data['errors']['password'][] = 'Password incorrect';

            }
          } else {
            // User not found
            $data['errors']['email'][] = 'No user found';
          }
          

          
        }
        // Load view with errors
        $this->view('users/login', $data);


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      redirect('posts');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      session_destroy();
      redirect('users/login');
    }
  }