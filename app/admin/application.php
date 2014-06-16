<?php

/**
 * application.php - Write your custom code below.
*/

$metabox = Metabox::make('Informations', 'post')->set(array(
        Field::text('author', array('info' => 'Un message pour l\'auteur.')),
        Field::text('age'),
        Field::text('email', array('info' => 'Please insert your email address.')),
        Field::text('website', array('info' => 'Please specify your website address.')),
        Field::checkbox('enabled', array('title' => 'Activate')),
        Field::textarea('article-summary', array('info' => 'Insert content here.', 'title' => 'Summary')),
        Field::text('color', array('info' => 'Define an hexadecimal color.')),
        Field::checkboxes('sizes', array('small', 'medium', 'large'), array('info' => 'Choose one or more sizes.')),
        Field::radio('transport', array('none', 'postal', 'ups'), array('title' => 'Delivery', 'info' => 'Choose one delivery service.')),
        Field::select('country', array(array('belgique', 'portugal', 'canada'))),
        Field::select('country-invoice', array(array('belgique', 'portugal', 'canada')), true, array('title' => 'Invoice country')),
        Field::media('image', array('info' => 'Only accepts .jpg, .gif, .png files.', 'size' => 'themosis')),
        Field::media('file', array('info' => 'Only files.', 'type' => 'application')),
        Field::editor('summary'),
        Field::infinite('members', array(
            Field::text('name', array('info' => 'Set the name of the member.')),
            Field::checkbox('show'),
            Field::select('department', array(array('none', 'design', 'research', 'finance'))),
            Field::textarea('biography'),
            Field::checkboxes('colors', array('red', 'blue', 'green')),
            Field::radio('size', array('small', 'medium', 'large')),
            Field::media('profile', array('size' => 'themosis'))
        ), array('info' => 'Define your company members.', 'limit' => 5))
));

$metabox->validate(array(
    'author'    => array('textfield'),
    'age'       => array('num'),
    'email'     => array('email'),
    'website'   => array('url:http'),
    'content'   => array('kses:a|href|title,p,h3'),
    'color'     => array('color'),
    'file'      => array('file:pages'),
    'members'   => array(
        'name'      => array('textfield', 'max:5'),
        'profile'   => array('file:png')
    )
));

$books = PostType::make('th-books', 'Books', 'book')->set();
$books->setTitle('Enter the book name');

$bookInfos = Metabox::make('Details', $books->getSlug())->set(array(
    Field::text('auteur', array('info' => 'Inscrire le nom de l\'auteur.')),
    Field::textarea('sommaire'),
    Field::media('cover', array('title' => 'Couverture'))
));

Taxonomy::make('th-categories', $books->getSlug(), 'Categories', 'category')->set()->bind();

$page = Page::make('th-settings-page', 'Themosis')->set();
$page->addSections(array(
    Section::make('th-general', 'General'),
    Section::make('th-extras', 'Extras')
));

$page->addSettings(array(
    'th-general' => array(
        Field::text('facebook', array('info' => 'Enter your Facebook page name.')),
        Field::text('phone'),
        Field::checkbox('display', array('title' => 'Display website')),
        Field::checkboxes('text-size', array('small', 'normal', 'large'), array('title' => 'Text Sizes')),
        Field::textarea('address', array('info' => 'Type your full address.', 'title' => 'Votre adresse')),
        Field::select('offices', array(array('Belgique', 'Luxembourg', 'Portugal')), false, array('title' => 'Bureau', 'info' => 'Choose your location.')),
        Field::radio('css', array('blue', 'orange', 'green')),
        Field::media('company-picture', array('title' => 'Company Picture')),
        Field::infinite('policies', array(
            Field::text('title'),
            Field::textarea('text'),
            Field::media('file')
        )),
        Field::editor('conditions')
    ),
    'th-extras' => array(
        Field::text('something'),
        Field::checkbox('show-it')
    )
));

$page->validate(array(
    'facebook'  => array('textfield', 'max:10'),
    'policies'  => array(
        'title' => array('num')
    ),
    'something' => array('email')
));

$otherPage = Page::make('th-main-options', 'Options')->set(array('tabs' => false));

$otherPage->addSections(array(
    Section::make('th-main-general', 'General Options'),
    Section::make('th-main-setup', 'Setup')
));

$otherPage->addsettings(array(
    'th-main-general' => array(
        Field::text('application-name')
    ),
    'th-main-setup'     => array(
        Field::text('installation-name')
    )
));

$otherPage->validate(array(
    'application-name'  => array('max:20')
));