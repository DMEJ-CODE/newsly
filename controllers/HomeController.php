<?php

class HomeController extends Controller
{
    public function index()
    {
        // If user is already logged in, skip landing page and go straight to feed
        if (isset($_SESSION['user_id'])) {
            $this->redirect('dashboard');
        }

        // Otherwise show the landing page
        require 'views/home/index.php';
    }
}
