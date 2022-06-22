<?php

$page = new Timber\Post($post);

$context = Timber::context();

$context["page"] = $page;

$context[ "main_menu" ] = new Timber\Menu('main');

Timber::render('index.twig', $context);
