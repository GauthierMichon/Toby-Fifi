<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Form\ModifProduitType;
use App\Form\ProduitImageFormType;
use App\Form\ProduitType;
use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use App\Form\UserImageFormType;
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



        $form = $this->createForm(ModifProduitType::class, $modif_produit);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_produit);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif.html.twig', [
            "form" => $form->createView(),
            "id" => $id
        ]);
    }

    /**
     * @Route("/modif_produit_image/{id}", name="modif_produit_image")
     */
    public function modif_produit_image(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $modif_produit = $em->getRepository(Produit::class)->find($id);

        $ancienne_image = $modif_produit->getImageName();


        $modif_produit->setImageName(null);

        $form = $this->createForm(ProduitImageFormType::class, $modif_produit);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $modif_produit->getImageName();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('images_produits/', $filename);
            $modif_produit->setImageName($filename);

            unlink("images_produits/$ancienne_image");

            $em->persist($modif_produit);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif_user_image.html.twig', [
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

        $user_id = $this->getUser()->getId();

        


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_user);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif_user.html.twig', [
            "form" => $form->createView(),
            "user_id" => $user_id
        ]);
    }


    /**
     * @Route("/modif_user_image/{id}", name="modif_user_image")
     */
    public function modif_user_image(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $modif_user = $em->getRepository(User::class)->find($id);

        $ancienne_image = $modif_user->getImageName();


        $modif_user->setImageName(null);

        $form = $this->createForm(UserImageFormType::class, $modif_user);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $modif_user->getImageName();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('images_users/', $filename);
            $modif_user->setImageName($filename);

            unlink("images_users/$ancienne_image");

            $em->persist($modif_user);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif_user_image.html.twig', [
            "form" => $form->createView()
        ]);
    }


}
