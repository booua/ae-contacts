<?php

$f3=require('lib/base.php');
require_once('backend/config.php');

$f3->set('DEBUG',3);

$f3->set('AUTOLOAD',
				'./backend/;
				./ui/');

$f3->config('config.ini');

$f3->route('GET /','Render->renderAllCategoriesView');
$f3->route('GET /login','Render->renderLoginForm');
$f3->route('POST /login/auth','DataHandler->auth');
$f3->route('POST|GET /logout','DataHandler->logout');
$f3->route('GET /all_contacts','Render->renderAllContactsView');
$f3->route('GET /category/@category_id','Render->renderSingleCategoryView');
$f3->route('GET /category/@category_id/contact/@contact_id','Render->renderSingleContactView');
$f3->route('GET /category/@category_id/contact/@contact_id/delete','DataHandler->deleteContact');
$f3->route('GET|POST /category/@category_id/contact/@contact_id/update','DataHandler->updateContact');
$f3->route('GET /category/new_category','Render->renderNewCategoryView');
$f3->route('GET|POST /category/new_category/create','DataHandler->createNewCategory');
$f3->route('GET /category/@category_id/new_contact','Render->renderNewContactView');
$f3->route('GET|POST /category/@category_id/new_contact/create','DataHandler->createNewContact');
$f3->route('GET|POST /category/@category_id/search','DataHandler->searchEntry');
$f3->route('GET|POST /search','DataHandler->searchEntry');
$f3->route('GET /export_database','Helpers->exportDatabaseToCSV');


$f3->run();
