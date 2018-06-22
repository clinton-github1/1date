<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\FormServiceProvider;

class OneDate extends Application
{
    use Application\TwigTrait;
    // more traits in the future
}

$app = new OneDate();
$app['debug'] = true;

//-------------------------------------------------------------------
//                             DATABASE CONNECTION
//-------------------------------------------------------------------    

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'onedate',
        'username' => 'clinton',
        'password' => 'clinton',
    ),
));
//-------------------------------------------------------------------
//                            END DATABASE CONN
//-------------------------------------------------------------------  
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->get('/hello', function() {
    return 'Hello!';
});

$app->get('/hello/{name}', function($name) {
    return "Hello, {$name}!";
});

$app->get('/', function() use ($app) {
    return $app->render('index.php.twig');
});

//------------------------------------------------------------------------------------
//                            CONTACT FORM
//----------------------------------------------------------------------------------
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$app->register(new FormServiceProvider());

$app->match('/form', function (Request $request) use ($app) {
    // some default data for when the form is displayed the first time
    $data = array(
        'name' => 'Clinton Were',
        'email' => 'clinton@cohesiondigital.co.uk',
        'message' => 'Hello there',
    );

    $form = $app['form.factory']->createBuilder(FormType::class, $data)
        ->add('name')
        ->add('email')
        ->add('message')
        ->add('submit', SubmitType::class, [
            'label' => 'SEND',
        ])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        return $app->redirect('...');
    }

    return $app['twig']->render('partials/eng/contact-us.php.twig', array('form' => $form->createView()));
});
//----------------------------------------------------------------------------------------------------
//                                          START ENGLISH    
//---------------------------------------------------------------------------------------------------
$app->get('/index', function() use ($app) {
    
    return $app->render('index.php.twig');
})->bind('index');


$app->get('/diff-dates', function() use ($app) {
    return $app->render('partials/eng/different-dates.php.twig');
})->bind('diff-dates');


$app->get('/why-one-date', function() use($app){
    
    return $app->render('partials/eng/why-one-date.php.twig');
})->bind('why-one-date');


$app->get('/what-can-we-do', function() use($app){
    
    return $app->render('partials/eng/what-can-we-do.php.twig');
})->bind('what-can-we-do');


$app->get('/endorsement', function() use($app){
    
    return $app->render('partials/eng/endorsement.php.twig');
})->bind('endorsement');


$app->get('/inspiration', function() use($app){
    
    return $app->render('partials/eng/inspiration.php.twig');
})->bind('inspiration');


$app->get('/sign-petition', function() use($app){
    
    return $app->render('partials/eng/sign-petition.php.twig');
})->bind('sign-petition');

//-----------------------------------ENG FOOTER-----------------------

$app->get('/tell-others', function() use($app){
    
    return $app->render('partials/eng/tell-others.php.twig');
})->bind('tell-others');

$app->get('/link-to-us', function() use($app){
    
    return $app->render('partials/eng/link-to-us.php.twig');
})->bind('link-to-us');

$app->get('/petition-kit', function() use($app){
    
    return $app->render('partials/eng/petition-kit.php.twig');
})->bind('petition-kit');

$app->get('/signatures', function() use($app){
    
    return $app->render('partials/eng/signatures.php.twig');
})->bind('signatures');

$app->get('/contact-us', function() use($app){
    
    return $app->render('partials/eng/contact-us.php.twig');
})->bind('contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END ENGLISH    
//---------------------------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------------------------
//                                          START CHINESE   
//---------------------------------------------------------------------------------------------------
$app->get('/ch-index', function() use ($app) {
    
    return $app->render('partials/chin/index.php.twig');
})->bind('ch-index');


$app->get('/ch-diff-dates', function() use ($app) {
    return $app->render('partials/chin/different-dates.php.twig');
})->bind('ch-diff-dates');


$app->get('/ch-why-one-date', function() use($app){
    
    return $app->render('partials/chin/why-one-date.php.twig');
})->bind('ch-why-one-date');


$app->get('/ch-what-can-we-do', function() use($app){
    
    return $app->render('partials/chin/what-can-we-do.php.twig');
})->bind('ch-what-can-we-do');


$app->get('/ch-endorsement', function() use($app){
    
    return $app->render('partials/chin/endorsement.php.twig');
})->bind('ch-endorsement');


$app->get('/ch-inspiration', function() use($app){
    
    return $app->render('partials/chin/inspiration.php.twig');
})->bind('ch-inspiration');


$app->get('/ch-sign-petition', function() use($app){
    
    return $app->render('partials/chin/sign-petition.php.twig');
})->bind('ch-sign-petition');

//-----------------------------------CHIN FOOTER-----------------------

$app->get('/ch-tell-others', function() use($app){
    
    return $app->render('partials/chin/tell-others.php.twig');
})->bind('ch-tell-others');

$app->get('/ch-link-to-us', function() use($app){
    
    return $app->render('partials/chin/link-to-us.php.twig');
})->bind('ch-link-to-us');

$app->get('/ch-petition-kit', function() use($app){
    
    return $app->render('partials/chin/petition-kit.php.twig');
})->bind('ch-petition-kit');

$app->get('/ch-signatures', function() use($app){
    
    return $app->render('partials/chin/signatures.php.twig');
})->bind('ch-signatures');

$app->get('/ch-contact-us', function() use($app){
    
    return $app->render('partials/chin/contact-us.php.twig');
})->bind('ch-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END CHINESE   
//---------------------------------------------------------------------------------------------------



//-----------------------------------------------------------------------------------------------------
//                                          START CZECH   
//---------------------------------------------------------------------------------------------------
$app->get('/cz-index', function() use ($app) {
    
    return $app->render('partials/czech/index.php.twig');
})->bind('cz-index');


$app->get('/cz-diff-dates', function() use ($app) {
    return $app->render('partials/czech/different-dates.php.twig');
})->bind('cz-diff-dates');


$app->get('/cz-why-one-date', function() use($app){
    
    return $app->render('partials/czech/why-one-date.php.twig');
})->bind('cz-why-one-date');


$app->get('/cz-what-can-we-do', function() use($app){
    
    return $app->render('partials/czech/what-can-we-do.php.twig');
})->bind('cz-what-can-we-do');


$app->get('/cz-endorsement', function() use($app){
    
    return $app->render('partials/czech/endorsement.php.twig');
})->bind('cz-endorsement');


$app->get('/cz-inspiration', function() use($app){
    
    return $app->render('partials/czech/inspiration.php.twig');
})->bind('cz-inspiration');


$app->get('/cz-sign-petition', function() use($app){
    
    return $app->render('partials/czech/sign-petition.php.twig');
})->bind('cz-sign-petition');

//-----------------------------------CZECH FOOTER-----------------------

$app->get('/cz-tell-others', function() use($app){
    
    return $app->render('partials/czech/tell-others.php.twig');
})->bind('cz-tell-others');

$app->get('/cz-link-to-us', function() use($app){
    
    return $app->render('partials/czech/link-to-us.php.twig');
})->bind('cz-link-to-us');

$app->get('/cz-petition-kit', function() use($app){
    
    return $app->render('partials/czech/petition-kit.php.twig');
})->bind('cz-petition-kit');

$app->get('/cz-signatures', function() use($app){
    
    return $app->render('partials/czech/signatures.php.twig');
})->bind('cz-signatures');

$app->get('/cz-contact-us', function() use($app){
    
    return $app->render('partials/czech/contact-us.php.twig');
})->bind('cz-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END CZECH  
//---------------------------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------------------------
//                                          START DANISH  
//---------------------------------------------------------------------------------------------------
$app->get('/dan-index', function() use ($app) {
    
    return $app->render('partials/dan/index.php.twig');
})->bind('dan-index');


$app->get('/dan-diff-dates', function() use ($app) {
    return $app->render('partials/dan/different-dates.php.twig');
})->bind('dan-diff-dates');


$app->get('/dan-why-one-date', function() use($app){
    
    return $app->render('partials/dan/why-one-date.php.twig');
})->bind('dan-why-one-date');


$app->get('/dan-what-can-we-do', function() use($app){
    
    return $app->render('partials/dan/what-can-we-do.php.twig');
})->bind('dan-what-can-we-do');


$app->get('/dan-endorsement', function() use($app){
    
    return $app->render('partials/dan/endorsement.php.twig');
})->bind('dan-endorsement');


$app->get('/dan-inspiration', function() use($app){
    
    return $app->render('partials/dan/inspiration.php.twig');
})->bind('dan-inspiration');


$app->get('/dan-sign-petition', function() use($app){
    
    return $app->render('partials/dan/sign-petition.php.twig');
})->bind('dan-sign-petition');

//-----------------------------------DANISH FOOTER-----------------------

$app->get('/dan-tell-others', function() use($app){
    
    return $app->render('partials/dan/tell-others.php.twig');
})->bind('dan-tell-others');

$app->get('/dan-link-to-us', function() use($app){
    
    return $app->render('partials/dan/link-to-us.php.twig');
})->bind('dan-link-to-us');

$app->get('/dan-petition-kit', function() use($app){
    
    return $app->render('partials/dan/petition-kit.php.twig');
})->bind('dan-petition-kit');

$app->get('/dan-signatures', function() use($app){
    
    return $app->render('partials/dan/signatures.php.twig');
})->bind('dan-signatures');

$app->get('/dan-contact-us', function() use($app){
    
    return $app->render('partials/dan/contact-us.php.twig');
})->bind('dan-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END DANISH 
//---------------------------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------------------------
//                                          START DEUTCH 
//---------------------------------------------------------------------------------------------------
$app->get('/deu-index', function() use ($app) {
    
    return $app->render('partials/deu/index.php.twig');
})->bind('deu-index');


$app->get('/deu-diff-dates', function() use ($app) {
    return $app->render('partials/deu/different-dates.php.twig');
})->bind('deu-diff-dates');


$app->get('/deu-why-one-date', function() use($app){
    
    return $app->render('partials/deu/why-one-date.php.twig');
})->bind('deu-why-one-date');


$app->get('/deu-what-can-we-do', function() use($app){
    
    return $app->render('partials/deu/what-can-we-do.php.twig');
})->bind('deu-what-can-we-do');


$app->get('/deu-endorsement', function() use($app){
    
    return $app->render('partials/deu/endorsement.php.twig');
})->bind('deu-endorsement');


$app->get('/deu-inspiration', function() use($app){
    
    return $app->render('partials/deu/inspiration.php.twig');
})->bind('deu-inspiration');


$app->get('/deu-sign-petition', function() use($app){
    
    return $app->render('partials/deu/sign-petition.php.twig');
})->bind('deu-sign-petition');

//-----------------------------------DEUTCH FOOTER-----------------------

$app->get('/deu-tell-others', function() use($app){
    
    return $app->render('partials/deu/tell-others.php.twig');
})->bind('deu-tell-others');

$app->get('/deu-link-to-us', function() use($app){
    
    return $app->render('partials/deu/link-to-us.php.twig');
})->bind('deu-link-to-us');

$app->get('/deu-petition-kit', function() use($app){
    
    return $app->render('partials/deu/petition-kit.php.twig');
})->bind('deu-petition-kit');

$app->get('/deu-signatures', function() use($app){
    
    return $app->render('partials/deu/signatures.php.twig');
})->bind('deu-signatures');

$app->get('/deu-contact-us', function() use($app){
    
    return $app->render('partials/deu/contact-us.php.twig');
})->bind('deu-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END DEUTCH  
//---------------------------------------------------------------------------------------------------


//-----------------------------------------------------------------------------------------------------
//                                          START ESPANOL 
//---------------------------------------------------------------------------------------------------
$app->get('/esp-index', function() use ($app) {
    
    return $app->render('partials/esp/index.php.twig');
})->bind('esp-index');


$app->get('/esp-diff-dates', function() use ($app) {
    return $app->render('partials/esp/different-dates.php.twig');
})->bind('esp-diff-dates');


$app->get('/esp-why-one-date', function() use($app){
    
    return $app->render('partials/esp/why-one-date.php.twig');
})->bind('esp-why-one-date');


$app->get('/esp-what-can-we-do', function() use($app){
    
    return $app->render('partials/esp/what-can-we-do.php.twig');
})->bind('esp-what-can-we-do');


$app->get('/esp-endorsement', function() use($app){
    
    return $app->render('partials/esp/endorsement.php.twig');
})->bind('esp-endorsement');


$app->get('/esp-inspiration', function() use($app){
    
    return $app->render('partials/esp/inspiration.php.twig');
})->bind('esp-inspiration');


$app->get('/esp-sign-petition', function() use($app){
    
    return $app->render('partials/esp/sign-petition.php.twig');
})->bind('esp-sign-petition');

//-----------------------------------ESPANOL FOOTER-----------------------

$app->get('/esp-tell-others', function() use($app){
    
    return $app->render('partials/esp/tell-others.php.twig');
})->bind('esp-tell-others');

$app->get('/esp-link-to-us', function() use($app){
    
    return $app->render('partials/esp/link-to-us.php.twig');
})->bind('esp-link-to-us');

$app->get('/esp-petition-kit', function() use($app){
    
    return $app->render('partials/esp/petition-kit.php.twig');
})->bind('esp-petition-kit');

$app->get('/esp-signatures', function() use($app){
    
    return $app->render('partials/esp/signatures.php.twig');
})->bind('esp-signatures');

$app->get('/esp-contact-us', function() use($app){
    
    return $app->render('partials/esp/contact-us.php.twig');
})->bind('esp-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END ESPANOL 
//---------------------------------------------------------------------------------------------------



//-----------------------------------------------------------------------------------------------------
//                                          START FRANCAIS 
//---------------------------------------------------------------------------------------------------
$app->get('/fr-index', function() use ($app) {
    
    return $app->render('partials/fran/index.php.twig');
})->bind('fr-index');


$app->get('/fr-diff-dates', function() use ($app) {
    return $app->render('partials/fran/different-dates.php.twig');
})->bind('fr-diff-dates');


$app->get('/fr-why-one-date', function() use($app){
    
    return $app->render('partials/fran/why-one-date.php.twig');
})->bind('fr-why-one-date');


$app->get('/fr-what-can-we-do', function() use($app){
    
    return $app->render('partials/fran/what-can-we-do.php.twig');
})->bind('fr-what-can-we-do');


$app->get('/fr-endorsement', function() use($app){
    
    return $app->render('partials/fran/endorsement.php.twig');
})->bind('fr-endorsement');


$app->get('/fr-inspiration', function() use($app){
    
    return $app->render('partials/fran/inspiration.php.twig');
})->bind('fr-inspiration');


$app->get('/fr-sign-petition', function() use($app){
    
    return $app->render('partials/fran/sign-petition.php.twig');
})->bind('fr-sign-petition');

//-----------------------------------ESPANOL FOOTER-----------------------

$app->get('/fr-tell-others', function() use($app){
    
    return $app->render('partials/fran/tell-others.php.twig');
})->bind('fr-tell-others');

$app->get('/fr-link-to-us', function() use($app){
    
    return $app->render('partials/fran/link-to-us.php.twig');
})->bind('fr-link-to-us');

$app->get('/fr-petition-kit', function() use($app){
    
    return $app->render('partials/fran/petition-kit.php.twig');
})->bind('fr-petition-kit');

$app->get('/fr-signatures', function() use($app){
    
    return $app->render('partials/fran/signatures.php.twig');
})->bind('fr-signatures');

$app->get('/fr-contact-us', function() use($app){
    
    return $app->render('partials/fran/contact-us.php.twig');
})->bind('fr-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END FRANCAIS 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START GREEK
//---------------------------------------------------------------------------------------------------
$app->get('/gr-index', function() use ($app) {
    
    return $app->render('partials/gre/index.php.twig');
})->bind('gr-index');


$app->get('/gr-diff-dates', function() use ($app) {
    return $app->render('partials/gre/different-dates.php.twig');
})->bind('gr-diff-dates');


$app->get('/gr-why-one-date', function() use($app){
    
    return $app->render('partials/gre/why-one-date.php.twig');
})->bind('gr-why-one-date');


$app->get('/gr-what-can-we-do', function() use($app){
    
    return $app->render('partials/gre/what-can-we-do.php.twig');
})->bind('gr-what-can-we-do');


$app->get('/gr-endorsement', function() use($app){
    
    return $app->render('partials/gre/endorsement.php.twig');
})->bind('gr-endorsement');


$app->get('/gr-inspiration', function() use($app){
    
    return $app->render('partials/gre/inspiration.php.twig');
})->bind('gr-inspiration');


$app->get('/gr-sign-petition', function() use($app){
    
    return $app->render('partials/gre/sign-petition.php.twig');
})->bind('gr-sign-petition');

//-----------------------------------GREEK FOOTER-----------------------

$app->get('/gr-tell-others', function() use($app){
    
    return $app->render('partials/gre/tell-others.php.twig');
})->bind('gr-tell-others');

$app->get('/gr-link-to-us', function() use($app){
    
    return $app->render('partials/gre/link-to-us.php.twig');
})->bind('gr-link-to-us');

$app->get('/gr-petition-kit', function() use($app){
    
    return $app->render('partials/gre/petition-kit.php.twig');
})->bind('gr-petition-kit');

$app->get('/gr-signatures', function() use($app){
    
    return $app->render('partials/gre/signatures.php.twig');
})->bind('gr-signatures');

$app->get('/gr-contact-us', function() use($app){
    
    return $app->render('partials/gre/contact-us.php.twig');
})->bind('gr-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END GREEK 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START HUNGARIAN
//---------------------------------------------------------------------------------------------------
$app->get('/hu-index', function() use ($app) {
    
    return $app->render('partials/hung/index.php.twig');
})->bind('hu-index');


$app->get('hu-diff-dates', function() use ($app) {
    return $app->render('partials/hung/different-dates.php.twig');
})->bind('hu-diff-dates');


$app->get('/hu-why-one-date', function() use($app){
    
    return $app->render('partials/hung/why-one-date.php.twig');
})->bind('hu-why-one-date');


$app->get('/hu-what-can-we-do', function() use($app){
    
    return $app->render('partials/hung/what-can-we-do.php.twig');
})->bind('hu-what-can-we-do');


$app->get('/hu-endorsement', function() use($app){
    
    return $app->render('partials/hung/endorsement.php.twig');
})->bind('hu-endorsement');


$app->get('/hu-inspiration', function() use($app){
    
    return $app->render('partials/hung/inspiration.php.twig');
})->bind('hu-inspiration');


$app->get('/hu-sign-petition', function() use($app){
    
    return $app->render('partials/hung/sign-petition.php.twig');
})->bind('hu-sign-petition');

//-----------------------------------HUNGARIAN FOOTER-----------------------

$app->get('/hu-tell-others', function() use($app){
    
    return $app->render('partials/hung/tell-others.php.twig');
})->bind('hu-tell-others');

$app->get('/hu-link-to-us', function() use($app){
    
    return $app->render('partials/hung/link-to-us.php.twig');
})->bind('hu-link-to-us');

$app->get('/hu-petition-kit', function() use($app){
    
    return $app->render('partials/hung/petition-kit.php.twig');
})->bind('hu-petition-kit');

$app->get('/hu-signatures', function() use($app){
    
    return $app->render('partials/hung/signatures.php.twig');
})->bind('hu-signatures');

$app->get('/hu-contact-us', function() use($app){
    
    return $app->render('partials/hung/contact-us.php.twig');
})->bind('hu-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END HUNGARIAN 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START ITALIANO
//---------------------------------------------------------------------------------------------------
$app->get('/it-index', function() use ($app) {
    
    return $app->render('partials/ita/index.php.twig');
})->bind('it-index');


$app->get('it-diff-dates', function() use ($app) {
    return $app->render('partials/ita/different-dates.php.twig');
})->bind('it-diff-dates');


$app->get('/it-why-one-date', function() use($app){
    
    return $app->render('partials/ita/why-one-date.php.twig');
})->bind('it-why-one-date');


$app->get('/it-what-can-we-do', function() use($app){
    
    return $app->render('partials/ita/what-can-we-do.php.twig');
})->bind('it-what-can-we-do');


$app->get('/it-endorsement', function() use($app){
    
    return $app->render('partials/ita/endorsement.php.twig');
})->bind('it-endorsement');


$app->get('/it-inspiration', function() use($app){
    
    return $app->render('partials/ita/inspiration.php.twig');
})->bind('it-inspiration');


$app->get('/it-sign-petition', function() use($app){
    
    return $app->render('partials/ita/sign-petition.php.twig');
})->bind('it-sign-petition');

//-----------------------------------ITALIANO FOOTER-----------------------

$app->get('/it-tell-others', function() use($app){
    
    return $app->render('partials/ita/tell-others.php.twig');
})->bind('it-tell-others');

$app->get('/it-link-to-us', function() use($app){
    
    return $app->render('partials/ita/link-to-us.php.twig');
})->bind('it-link-to-us');

$app->get('/it-petition-kit', function() use($app){
    
    return $app->render('partials/ita/petition-kit.php.twig');
})->bind('it-petition-kit');

$app->get('/it-signatures', function() use($app){
    
    return $app->render('partials/ita/signatures.php.twig');
})->bind('it-signatures');

$app->get('/it-contact-us', function() use($app){
    
    return $app->render('partials/ita/contact-us.php.twig');
})->bind('it-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END ITALIANO 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START JAPANESE
//---------------------------------------------------------------------------------------------------
$app->get('/jap-index', function() use ($app) {
    
    return $app->render('partials/jap/index.php.twig');
})->bind('jap-index');


$app->get('jap-diff-dates', function() use ($app) {
    return $app->render('partials/jap/different-dates.php.twig');
})->bind('jap-diff-dates');


$app->get('/jap-why-one-date', function() use($app){
    
    return $app->render('partials/jap/why-one-date.php.twig');
})->bind('jap-why-one-date');


$app->get('/jap-what-can-we-do', function() use($app){
    
    return $app->render('partials/jap/what-can-we-do.php.twig');
})->bind('jap-what-can-we-do');


$app->get('/jap-endorsement', function() use($app){
    
    return $app->render('partials/jap/endorsement.php.twig');
})->bind('jap-endorsement');


$app->get('/jap-inspiration', function() use($app){
    
    return $app->render('partials/jap/inspiration.php.twig');
})->bind('jap-inspiration');


$app->get('/jap-sign-petition', function() use($app){
    
    return $app->render('partials/jap/sign-petition.php.twig');
})->bind('jap-sign-petition');

//-----------------------------------JAPANESE FOOTER-----------------------

$app->get('/jap-tell-others', function() use($app){
    
    return $app->render('partials/jap/tell-others.php.twig');
})->bind('jap-tell-others');

$app->get('/jap-link-to-us', function() use($app){
    
    return $app->render('partials/jap/link-to-us.php.twig');
})->bind('jap-link-to-us');

$app->get('/jap-petition-kit', function() use($app){
    
    return $app->render('partials/jap/petition-kit.php.twig');
})->bind('jap-petition-kit');

$app->get('/jap-signatures', function() use($app){
    
    return $app->render('partials/jap/signatures.php.twig');
})->bind('jap-signatures');

$app->get('/jap-contact-us', function() use($app){
    
    return $app->render('partials/jap/contact-us.php.twig');
})->bind('jap-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END JAPANESE 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START NEDERLANDS
//---------------------------------------------------------------------------------------------------
$app->get('/ned-index', function() use ($app) {
    
    return $app->render('partials/ned/index.php.twig');
})->bind('ned-index');


$app->get('ned-diff-dates', function() use ($app) {
    return $app->render('partials/ned/different-dates.php.twig');
})->bind('ned-diff-dates');


$app->get('/ned-why-one-date', function() use($app){
    
    return $app->render('partials/ned/why-one-date.php.twig');
})->bind('ned-why-one-date');


$app->get('/ned-what-can-we-do', function() use($app){
    
    return $app->render('partials/ned/what-can-we-do.php.twig');
})->bind('ned-what-can-we-do');


$app->get('/ned-endorsement', function() use($app){
    
    return $app->render('partials/ned/endorsement.php.twig');
})->bind('ned-endorsement');


$app->get('/ned-inspiration', function() use($app){
    
    return $app->render('partials/ned/inspiration.php.twig');
})->bind('ned-inspiration');


$app->get('/ned-sign-petition', function() use($app){
    
    return $app->render('partials/ned/sign-petition.php.twig');
})->bind('ned-sign-petition');

//-----------------------------------NEDERLANDS FOOTER-----------------------

$app->get('/ned-tell-others', function() use($app){
    
    return $app->render('partials/ned/tell-others.php.twig');
})->bind('ned-tell-others');

$app->get('/ned-link-to-us', function() use($app){
    
    return $app->render('partials/ned/link-to-us.php.twig');
})->bind('ned-link-to-us');

$app->get('/ned-petition-kit', function() use($app){
    
    return $app->render('partials/ned/petition-kit.php.twig');
})->bind('ned-petition-kit');

$app->get('/ned-signatures', function() use($app){
    
    return $app->render('partials/ned/signatures.php.twig');
})->bind('ned-signatures');

$app->get('/ned-contact-us', function() use($app){
    
    return $app->render('partials/ned/contact-us.php.twig');
})->bind('ned-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END NEDERLANDS 
//---------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------
//                                          START POLSKA
//---------------------------------------------------------------------------------------------------
$app->get('/pol-index', function() use ($app) {
    
    return $app->render('partials/pol/index.php.twig');
})->bind('pol-index');


$app->get('pol-diff-dates', function() use ($app) {
    return $app->render('partials/pol/different-dates.php.twig');
})->bind('pol-diff-dates');


$app->get('/pol-why-one-date', function() use($app){
    
    return $app->render('partials/pol/why-one-date.php.twig');
})->bind('pol-why-one-date');


$app->get('/pol-what-can-we-do', function() use($app){
    
    return $app->render('partials/pol/what-can-we-do.php.twig');
})->bind('pol-what-can-we-do');


$app->get('/pol-endorsement', function() use($app){
    
    return $app->render('partials/pol/endorsement.php.twig');
})->bind('pol-endorsement');


$app->get('/pol-inspiration', function() use($app){
    
    return $app->render('partials/pol/inspiration.php.twig');
})->bind('pol-inspiration');


$app->get('/pol-sign-petition', function() use($app){
    
    return $app->render('partials/pol/sign-petition.php.twig');
})->bind('pol-sign-petition');

//-----------------------------------POLSKA FOOTER-----------------------

$app->get('/pol-tell-others', function() use($app){
    
    return $app->render('partials/pol/tell-others.php.twig');
})->bind('pol-tell-others');

$app->get('/pol-link-to-us', function() use($app){
    
    return $app->render('partials/pol/link-to-us.php.twig');
})->bind('pol-link-to-us');

$app->get('/pol-petition-kit', function() use($app){
    
    return $app->render('partials/pol/petition-kit.php.twig');
})->bind('pol-petition-kit');

$app->get('/pol-signatures', function() use($app){
    
    return $app->render('partials/pol/signatures.php.twig');
})->bind('pol-signatures');

$app->get('/pol-contact-us', function() use($app){
    
    return $app->render('partials/pol/contact-us.php.twig');
})->bind('pol-contact-us');

//-----------------------------------------------------------------------------------------------------
//                                               END POLSKA 
//---------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//                                          START PORTUGUESE
//---------------------------------------------------------------------------------------------------
$app->get('/por-index', function() use ($app) {
    
    return $app->render('partials/por/index.php.twig');
})->bind('por-index');


$app->get('por-diff-dates', function() use ($app) {
    return $app->render('partials/por/different-dates.php.twig');
})->bind('por-diff-dates');


$app->get('/por-why-one-date', function() use($app){
    
    return $app->render('partials/por/why-one-date.php.twig');
})->bind('por-why-one-date');


$app->get('/por-what-can-we-do', function() use($app){
    
    return $app->render('partials/por/what-can-we-do.php.twig');
})->bind('por-what-can-we-do');


$app->get('/por-endorsement', function() use($app){
    
    return $app->render('partials/por/endorsement.php.twig');
})->bind('por-endorsement');


$app->get('/por-inspiration', function() use($app){
    
    return $app->render('partials/por/inspiration.php.twig');
})->bind('por-inspiration');


$app->get('/por-sign-petition', function() use($app){
    
    return $app->render('partials/por/sign-petition.php.twig');
})->bind('por-sign-petition');

//----------------------------------- PORTUGUESE FOOTER-----------------------

$app->get('/por-tell-others', function() use($app){
    
    return $app->render('partials/por/tell-others.php.twig');
})->bind('por-tell-others');

$app->get('/por-link-to-us', function() use($app){
    
    return $app->render('partials/por/link-to-us.php.twig');
})->bind('por-link-to-us');

$app->get('/por-petition-kit', function() use($app){
    
    return $app->render('partials/por/petition-kit.php.twig');
})->bind('por-petition-kit');

$app->get('/por-signatures', function() use($app){
    
    return $app->render('partials/por/signatures.php.twig');
})->bind('por-signatures');

$app->get('/por-contact-us', function() use($app){
    
    return $app->render('partials/por/contact-us.php.twig');
})->bind('por-contact-us');

//---------------------------------------------------------------------------------------------------
//                                               END PORTUGUESE 
//---------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
//                                          START RUSSIA
//---------------------------------------------------------------------------------------------------
$app->get('/rus-index', function() use ($app) {
    
    return $app->render('partials/rus/index.php.twig');
})->bind('rus-index');


$app->get('rus-diff-dates', function() use ($app) {
    return $app->render('partials/rus/different-dates.php.twig');
})->bind('rus-diff-dates');


$app->get('/rus-why-one-date', function() use($app){
    
    return $app->render('partials/rus/why-one-date.php.twig');
})->bind('rus-why-one-date');


$app->get('/rus-what-can-we-do', function() use($app){
    
    return $app->render('partials/rus/what-can-we-do.php.twig');
})->bind('rus-what-can-we-do');


$app->get('/rus-endorsement', function() use($app){
    
    return $app->render('partials/rus/endorsement.php.twig');
})->bind('rus-endorsement');


$app->get('/rus-inspiration', function() use($app){
    
    return $app->render('partials/rus/inspiration.php.twig');
})->bind('rus-inspiration');


$app->get('/rus-sign-petition', function() use($app){
    
    return $app->render('partials/rus/sign-petition.php.twig');
})->bind('rus-sign-petition');

//-----------------------------------RUSSIA FOOTER-----------------------

$app->get('/rus-tell-others', function() use($app){
    
    return $app->render('partials/rus/tell-others.php.twig');
})->bind('rus-tell-others');

$app->get('/rus-link-to-us', function() use($app){
    
    return $app->render('partials/rus/link-to-us.php.twig');
})->bind('rus-link-to-us');

$app->get('/rus-petition-kit', function() use($app){
    
    return $app->render('partials/rus/petition-kit.php.twig');
})->bind('rus-petition-kit');

$app->get('/rus-signatures', function() use($app){
    
    return $app->render('partials/rus/signatures.php.twig');
})->bind('rus-signatures');

$app->get('/rus-contact-us', function() use($app){
    
    return $app->render('partials/rus/contact-us.php.twig');
})->bind('rus-contact-us');

//---------------------------------------------------------------------------------------------------
//                                               END RUSSIA 
//---------------------------------------------------------------------------------------------------


$app->run();
