<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Form\ProduitType;
use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {

        $Produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'produits' => $Produits,
        ]);
    }

    /**
     * @Route("/home_user", name="home_user")
     */
    public function home_user()
    {

        $Produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
            
        $user_id = $this->getUser()->getId();


        return $this->render('home/home_user.html.twig', [
            'produits' => $Produits,
            'user_id' => $user_id,
        ]);
    }

    /**
     * @Route("/produit/{id}", name="show_post")
     */
    public function show(Produit $produit)
    {
        return $this->render('home/produit.html.twig', [
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {

        $produit = new Produit();

        $form = $this->createForm(ProduitType::class, $produit);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $produit->getImageName();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('images_produits/', $filename);
            $produit->setImageName($filename);

            $em->persist($produit);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_post")
     */
    public function delete(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $modif_produit = $em->getRepository(Produit::class)->find($id);

        $em->remove($modif_produit);
        $em->flush();

        return new RedirectResponse('/home');

        return $this->render('home/delete.html.twig', [
        ]);
    }

    /**
     * @Route("/modif/{id}", name="modif_produit")
     */
    public function modif(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $modif_produit = $em->getRepository(Produit::class)->find($id);


        $form = $this->createForm(ProduitType::class, $modif_produit);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_produit);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif.html.twig', [
            "form" => $form->createView()
        ]);
    }

    
    /**
     * @Route("/modif_user/{id}", name="modif_user")
     */
    public function modif_user(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $modif_user = $em->getRepository(User::class)->find($id);


        $form = $this->createForm(UserFormType::class, $modif_user);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_user);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
