<?php

class DataHandler{

  function createNewContact($f3){
    $company=new DB\SQL\Mapper($f3->get('DB'),'contacts');
    $company->name=$f3->get("POST.company_name");
    $company->category_id=$f3->get("PARAMS.category_id");
    $company->website=$f3->get("POST.company_website");
    $company->facebook=$f3->get("POST.company_facebook");
    $company->email=$f3->get("POST.company_email");
    $company->phone=$f3->get("POST.company_phone");
    $company->additional=$f3->get("POST.company_additional");
    $company->save();
    $f3->reroute('./?success=1');
    }

  function deleteContact($f3){
    echo 'deleteQuery';
  }

  function updateContact($f3){

  }

  function createNewCategory($f3){
      $category=new DB\SQL\Mapper($f3->get('DB'),'category');
      $category->name=$f3->get("POST.company_name");
      $category->icon=$f3->get("POST.company_icon");
      $category->save();
      $f3->reroute('./?success=1');

  }

  function searchForContact($f3){


}

  function searchEntry($f3){
    $search_query = $f3->get("POST.search_query");
      if($f3->get("PARAMS.category_id")){
          echo(json_encode($f3->get('DB')->exec("SELECT * FROM contacts WHERE name LIKE ?",array(1=>$search_query))));
      }else{
          echo(json_encode($f3->get('DB')->exec("SELECT * FROM category WHERE name LIKE ?",array(1=>$search_query))));
      }
    }
  }

?>
