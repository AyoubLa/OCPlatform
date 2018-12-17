<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){

            throw new NotFoundHttpException('Page "'.$page.'" inexistante');
        }

    	return $this->render('OCPlatformBundle:Advert:index.html.twig', array('listAdverts' =>  array()
        ));
    }

    public function viewAction($id)
    {
        
    	return $this->render('OCPlatformBundle:Advert:view.html.twig', array('id' => $id,'tag' => $tag ));
    }

    public function viewSlugAction($year, $slug, $_format)
    {
        
    	return new Response($year.":".$slug.":".$_format);
    }

    public function addAction(Request $request)
    {
        
        if($request->isMethod("POST")){

            $request->getSession()->getFlashBag()->add('info', 'Annonce bien enregistrée');

            // Puis on redirige vers la page de visualisation de cette annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => 5));
        }
        
        return $this->redirect('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        if($request->isMethod("POST")){

            $request->getSession()->getFlashBag()->add('info', 'Annonce bien modifiée');

            // Puis on redirige vers la page de visualisation de cette annonce
            return $this->redirectToRoute('oc_platform_view', array('id' => $id));

        }
    	return $this->redirect('OCPlatformBundle:Advert:edit.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->redirect('OCPlatformBundle:Advert:delete.html.twig');
    }

    public function menuAction()
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
          array('id' => 2, 'title' => 'Recherche développeur Symfony'),
          array('id' => 5, 'title' => 'Mission de webmaster'),
          array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
          // Tout l'intérêt est ici : le contrôleur passe
          // les variables nécessaires au template !
          'listAdverts' => $listAdverts
        ));
    }
}
