<?php
class Render{

  function renderAllCategoriesView($f3){
    $f3->set('all_categories',$f3->get('DB')->exec("SELECT * FROM category"));
    $f3->set('page_title','All categories');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'mainView.html');
  }

  function renderSingleCategoryView($f3){


      $category_id = $f3->get("PARAMS.category_id");
      $page_nr = $f3->get("PARAMS.page_nr")-1;
      $f3->set('all_contacts',$f3->get('DB')->exec("SELECT SQL_CALC_FOUND_ROWS category.name, contacts.* FROM category
                                                    JOIN contacts ON contacts.category_id = category.id
                                                    WHERE category.id = ? LIMIT 25 OFFSET ?",array(1=>$category_id,2=>$page_nr*25)));

      $f3->set('contact_count',$f3->get('DB')->exec("SELECT FOUND_ROWS()"));

      $f3->set('page_title','Companies');
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
                                                      2=>$contact_id))[0]);
    $f3->set('page_title',$f3->get('single_contact')['name']);
    $template=new Template;
    echo $template->render($f3->get('templates') . 'singleContactView.html');
  }

  function renderAllContactsView($f3){
    $f3->set('page_title','All companies');
    $f3->set('all_contacts',$f3->get('DB')->exec("SELECT * FROM contacts"));
    $template=new Template;
    echo $template->render($f3->get('templates') . 'AllContactsView.html');
  }

  function renderNewContactView($f3){
    $f3->set('page_title','New contact');
    $f3->set('form_type', 'contact');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'CreateNew.html');
  }

  function renderNewCategoryView($f3){
    $f3->set('page_title','New category');
    $f3->set('form_type', 'category');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'CreateNew.html');
  }

  function notAuthorized($f3){
    $f3->set('page_title','Not Authorized');
    $template=new Template;
    echo $template->render($f3->get('templates') . 'Unauthorized.html');
  }
}
