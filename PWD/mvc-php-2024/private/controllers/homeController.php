<?php

/**
 *
 */
class Home extends Controllers
{

  public $section = '';

  public function index()
  {
    // //guardar logs
    // $data = $_REQUEST;
    // $dataModel = new homeModel(DBM_MYSQL);
    // $dataModel = $dataModel->getAll();
    // if(){
    //   require_once("./views/homeView.php");
    // }else{
    //   header("Location: ".Helpers::base_url()."users/index");
    // }
    require_once("./private/views/homeView.php");
  }
}
