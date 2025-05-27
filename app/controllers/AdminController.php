<?php
class AdminController{
    public function dashboard(){
        $data = [];
        render('admin/dashboard', $data, "admin/layout");
    }
}
?>