<?php


$page_list = array(
  array(
    "name"=>"welcome",
    "title"=>"Accueil de notre site",
    "menutitle"=>"Accueil"),
  array(
    "name"=>"contacts",
    "title"=>"Qui sommes-nous", 
    "menutitle"=>"Nous contacter"
     ),
  array(
      "name"=>"news",
      "title"=>"Quoi de neuf?",
      "menutitle"=>"Nouvelles"
  )
);

function checkPage($askedPage){
    global $page_list;
    $a=false;
    foreach($page_list as $page){
        if ($page["name"]==$askedPage){
            $a=true;
        }
        
    }
    return $a;
}

function getPageTitle($askedPage){
    global $page_list;
    $a="";
    foreach($page_list as $page){
        if ($page["name"]==$askedPage){
            $a=$page['title'];
        }
    }
    return $a;
}
