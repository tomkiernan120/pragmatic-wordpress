<?php

$context = Timber::context();
$context['post'] = new Timber\Post(); 

Timber::render('views/single.twig', $context);