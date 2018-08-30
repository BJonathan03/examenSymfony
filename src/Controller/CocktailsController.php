<?php

namespace App\Controller;

use App\Entity\Cocktails;
use App\Form\CocktailType;
use App\Repository\CocktailsRepository;
use App\Repository\IngredientsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CocktailsController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function index(CocktailsRepository $repo)
    {
        $cocktails = $repo->findAll();
        return $this->render('cocktails/home.html.twig', [
            'controller_name' => 'CocktailsController',
            'cocktails' => $cocktails,
        ]);
    }

    /**
     * @route("/new", name="cocktail_create")       //Attention cette route doit-être placée avant show car si on appelle la route /{id} il ne peut pas savoir que id doit etre un INT ou alors, il faut le préciser
     * @route("/edit/{id}", name="cocktail_edit")   //La premiere route est appelée pour la création, la deuxieme pour la modification
     */

    public function form(Cocktails $cocktail = null, Request $request, ObjectManager $manager){

        if(!$cocktail){
            $cocktail = new Cocktails();
        }

        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);        //HandleRequest analyse du formulaire

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($cocktail);
            $manager->flush();

            return $this->redirectToRoute('cocktail_show', ['id' => $cocktail->getId()]);
        }

        return $this->render('cocktails/create.html.twig',[
            'formCocktail' =>$form->createView(),   //createView : methode de Form qui retourne la 'partie affichage de l'objet)
            'editMode' => $cocktail->getId() !== null
        ]);
    }
    /**
     * @Route("/ingredients", name="ingredients")
     */

    public function ingredient(IngredientsRepository $repo){
        $ingredients = $repo->findAll();
        return $this->render('cocktails/index.html.twig', [
            'controller_name' => 'CocktailsController',
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * @Route("/{id}", name="cocktail_show")
     *
     */

    public function show(Cocktails $cocktail){
        return $this->render('cocktails/show.html.twig', [
            'cocktail'=> $cocktail
        ]);
    }

    /**
     * @Route("/cinema/{id}/delete", name="delete")
     */

    public function deleteCocktail(Cocktails $cocktail, Request $request, ObjectManager $manager){
        $manager->remove($cocktail);
        $manager->flush();
        return $this->redirectToRoute('home');
    }
}
