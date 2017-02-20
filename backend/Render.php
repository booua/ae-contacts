<?php

class Render{
  function renderAllCategoriesView($f3){


    $f3->set('all_categories',$f3->get('DB')->exec("SELECT * FROM category"));
    $template=new Template;
    echo $template->render($f3->get('templates') . 'mainView.html');
  }

  function renderSingleCategoryView($f3){
      $category_id = $f3->get("PARAMS.category_id");
      $f3->set('all_contacts',$f3->get('DB')->exec("SELECT category.*, contacts.* FROM category
                                                    JOIN contacts ON contacts.category_id = category.id
                                                    WHERE category.id = ?",array(1=>$category_id)));
      $template=new Template;
      echo $template->render($f3->get('templates') . 'singleCategoryView.html');
  }

  function renderSingleContactView($f3){
    $contact_id = $f3->get("PARAMS.contact_id");
    $category_id = $f3->get("PARAMS.category_id");
    $f3->set('single_contact',$f3->get('DB')->exec("SELECT * FROM contacts
                                                    WHERE contacts.category_id = ?
                                                    AND contacts.id = ?",array(
                                                      1=>$category_id,
                                                      2=>$contact_id)));
    $template=new Template;
    echo $template->render($f3->get('templates') . 'singleContactView.html');
  }

  function renderAllContactsView($f3){

  }

  function renderNewContactView($f3){
    $f3->set('form_type', 'contact');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'CreateNew.html');
  }

  function renderNewCategoryView($f3){
    $f3->set('form_type', 'category');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'CreateNew.html');
  }

}
