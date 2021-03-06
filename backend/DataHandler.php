<?php

class DataHandler{

  function auth($f3){

    $ae_auth = new AeAuth($f3->get("auth_config"));
    $crypto = new Crypto();
    $key = $f3->get("GET.key");
    $decryptedKey = $crypto->decrypt($f3->get("auth_config")['secret_key'], $key);
    $ae_auth->authorize_with_key($decryptedKey);
    $f3->reroute('../');
  }
  function logout($f3){
    $ae_auth = new AeAuth($f3->get("auth_config"));
    $ae_auth->destroy_session();
    unset($_SESSION['ae_key']);
    session_destroy();
    $f3->reroute('https://login.artistscrew.com');

  }
  function createNewContact($f3){

    $helper = new Helpers();
    if(!$helper->checkForDuplicateEntry($f3, $f3->get("POST.company_name"), $f3->get('SEARCH_CONTACT'))){
          $company=new DB\SQL\Mapper($f3->get('DB'),'contacts');
          $company->name=$f3->get("POST.company_name");
          $company->category_id=$f3->get("PARAMS.category_id");
          $company->website=$f3->get("POST.company_website");
          $company->facebook=$f3->get("POST.company_facebook");
          $company->email=$f3->get("POST.company_email");
          $company->phone=$f3->get("POST.company_phone");
          $company->additional=$f3->get("POST.company_additional");
          $company->save();
          $f3->reroute('../page/1/?message_type=created');
        }else{
          $f3->reroute('./?message_type=duplicate');
        }
    }

  function deleteContact($f3){
          $contact=new DB\SQL\Mapper($f3->get('DB'),'contacts');
          $contact->load(array('id=?',$f3->get("PARAMS.contact_id")));
          $contact->erase();
          $f3->reroute('../../page/1/?message_type=deleted');
  }

  function updateContact($f3){
        $f3->get('DB')->exec("UPDATE contacts
                              SET name = :name, website = :web, facebook = :face, email = :email, phone = :phone, additional = :add
                              WHERE id = :id",
        array(
        'name'=>$f3->get("POST.company_name"),
        'web'=>$f3->get("POST.company_website"),
        'face'=>$f3->get("POST.company_facebook"),
        'email'=>$f3->get("POST.company_email"),
        'phone'=>$f3->get("POST.company_phone"),
        'add'=>$f3->get("POST.company_additional"),
        'id'=>$f3->get("PARAMS.contact_id")));
        $f3->reroute('./?message_type=updated');
  }

  function createNewCategory($f3){

      $helper = new Helpers();
      if(!$helper->checkForDuplicateEntry($f3, $f3->get("POST.company_name"), $f3->get('SEARCH_CATEGORY'))){
      $category=new DB\SQL\Mapper($f3->get('DB'),'category');
      $category->name=$f3->get("POST.company_name");
      $category->icon=$f3->get("POST.company_icon");
      $category->save();
      $f3->reroute('../../?message_type=created');
    }else{
      $f3->reroute('./?message_type=duplicate');
    }

  }


  function searchEntry($f3){
    $search_query = $f3->get("POST.search_query");
      if($f3->get("PARAMS.category_id")){
          echo(json_encode($f3->get('DB')->exec("SELECT * FROM contacts WHERE name LIKE ? AND category_id=?",array(1=>$search_query,2=>$f3->get("PARAMS.category_id")))));
      }else{
          echo(json_encode($f3->get('DB')->exec("SELECT * FROM category WHERE name LIKE ?",array(1=>$search_query))));
      }
    }
  }

?>
