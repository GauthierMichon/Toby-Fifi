<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Entity\Notes;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Entity\User;
use App\Entity\Ventes;
use App\Form\CommentairesFormType;
use App\Form\ModifProduitType;
use App\Form\NotesFormType;
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

        $user = $this->getUser();


        return $this->render('home/home_user.html.twig', [
            'produits' => $Produits,
            'user' => $user,
        ]);
    }


    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche(EntityManagerInterface $em)
    {

        $recherche = $_POST['rechercher'];

        $query = $em->createQuery(
            'SELECT p
            FROM App\Entity\Produit p
            WHERE p.nom LIKE :recherche'
        )->setParameter('recherche', '%'.$recherche.'%');

        // returns an array of Product objects
        
        $Produits = $query->getResult();

        $user = $this->getUser();

        if (!empty($user)) {
            return $this->render('home/recherche.html.twig', [
                'produits' => $Produits,
                "recherche" => $recherche,
                "user" => $user
            ]);
        }

        else {
            return $this->render('home/recherche.html.twig', [
                'produits' => $Produits,
                "recherche" => $recherche,
            ]);
        }
    }


    /**
     * @Route("/produit/{id}", name="show_post")
     */
    public function show(int $id, Produit $produit, Request $request, EntityManagerInterface $em)
    {   

        $user = $this->getUser();
        $nb_note = 0;
        $total_note = 0;
        $moyenne = null;

        if (!empty($user)) {
            $em = $this->getDoctrine()->getManager();
            $modif_commentaire = $em
                ->getRepository(Commentaires::class)
                ->findBy(array('id_produit'=> $id, 'id_user'=> $user->getId()));


            $modif_note = $em
                ->getRepository(Notes::class)
                ->findBy(array('id_produit'=> $id, 'id_user'=> $user->getId()));
        }

        if (!empty($modif_commentaire)) {
            $form = $this->createForm(CommentairesFormType::class, $modif_commentaire[0]);
        }
        else {
            $commentaire = new Commentaires();

            $form = $this->createForm(CommentairesFormType::class, $commentaire);
        }


        $form->handleRequest($request);

        if (!empty($modif_commentaire) && $form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_commentaire[0]);
            $em->flush();     

            return $this->redirect($request->getUri());
        }

        else if (empty($modif_commentaire) && $form->isSubmitted() && $form->isValid()) {


            $commentaire->setIdUser($user->getId());
            $commentaire->setIdProduit($id);

            $em->persist($commentaire);
            $em->flush();
            

            return $this->redirect($request->getUri());

        }

        $em = $this->getDoctrine()->getManager();
        $commentaires = $em
            ->getRepository(Commentaires::class)
            ->findBy(array('id_produit'=> $id));

        

    
        if (!empty($modif_note)) {
            $form_note = $this->createForm(NotesFormType::class, $modif_note[0]);
        }
        else {
            $note = new Notes();

            $form_note = $this->createForm(NotesFormType::class, $note);
        }


        $form_note->handleRequest($request);


        if (!empty($modif_note) && $form_note->isSubmitted() && $form_note->isValid()) {
            $em->persist($modif_note[0]);
            $em->flush();     

            return $this->redirect($request->getUri());
        }

        else if (empty($modif_note) && $form_note->isSubmitted() && $form_note->isValid()) {


            $note->setIdUser($user->getId());
            $note->setIdProduit($id);

            $em->persist($note);
            $em->flush();
            

            return $this->redirect($request->getUri());

        }

        $em = $this->getDoctrine()->getManager();
        $notes = $em
            ->getRepository(Notes::class)
            ->findBy(array('id_produit'=> $id));

        foreach ($notes as $note) {
            $nb_note += 1;
            $total_note += $note->getNote();
        }

        if (!empty($notes)) {
            $moyenne = $total_note/$nb_note;
        }


        return $this->render('home/produit.html.twig', [
            'produit' => $produit,
            "form" => $form->createView(),
            "form_note" => $form_note->createView(),
            "commentaires" => $commentaires,
            "moyenne" => $moyenne
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
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
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
        $delete_produit = $em->getRepository(Produit::class)->find($id);
        $delete_produit_panier = $em->getRepository(Panier::class)->findBy(array('id_produit'=> $id));
        $delete_produit_notes = $em->getRepository(Notes::class)->findBy(array('id_produit'=> $id));
        $delete_produit_commentaires = $em->getRepository(Commentaires::class)->findBy(array('id_produit'=> $id));
        

        unlink("images_produits/".$delete_produit->getImageName());

        foreach ($delete_produit_panier as $supp_panier) {
            $em->remove($supp_panier);
        }

        foreach ($delete_produit_notes as $supp_note) {
            $em->remove($supp_note);
        }

        foreach ($delete_produit_commentaires as $supp_com) {
            $em->remove($supp_com);
        }


        $em->remove($delete_produit);
        $em->flush();

        return new RedirectResponse('/home_user');

        return $this->render('home/delete.html.twig', []);
    }

    /**
     * @Route("/delete_panier/{id}", name="delete_panier")
     */
    public function delete_panier(int $id, Request $request, EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $delete_produit = $em->getRepository(Produit::class)->find($id);

        $user = $this->getUser();

        $prod = $this->getDoctrine()
            ->getRepository(Panier::class)
            ->findBy(array('id_produit'=> $delete_produit->getId(), 'id_user'=> $user->getId()));


        $em->remove($prod[0]);
        $em->flush();

        return new RedirectResponse('/show_panier');

        return $this->render('home/delete_panier.html.twig', []);
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
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move('images_produits/', $filename);
            $modif_produit->setImageName($filename);

            unlink("images_produits/$ancienne_image");

            $em->persist($modif_produit);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif_produit_image.html.twig', [
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

        $user = $this->getUser();




        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($modif_user);
            $em->flush();

            return new RedirectResponse('/home_user');
        }

        return $this->render('home/modif_user.html.twig', [
            "form" => $form->createView(),
            "user" => $user
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
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
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

    /**
     * @Route("/add_panier/{id}", name="add_panier")
     */
    public function add_panier(int $id, EntityManagerInterface $em)
    {
        $panier = new Panier();
        $user_id = $this->getUser()->getId();

        $panier->setIdUser($user_id);
        $panier->setIdProduit($id);

        $em->persist($panier);
        $em->flush();


        return new RedirectResponse('/home_user');

        return $this->render('home/add_panier.html.twig', [
            
        ]);
    }

    /**
     * @Route("/show_panier", name="show_panier")
     */
    public function show_panier(EntityManagerInterface $em)
    {
        $user_id = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        $panier_user = $em->getRepository(Panier::class)->findBy(array('id_user'=> $user_id));


        $panier = [];
        $produits = [];
        $id_prod_panier = [];
        $total = 0;
        $error = null;

        foreach($panier_user as $produit) {

            $id = $produit->getIdProduit();

            $prod = $this->getDoctrine()
                ->getRepository(Produit::class)
                ->findBy(array('id'=> $id));

            array_push($panier, $prod);
            array_push($id_prod_panier, $id);
        }

        $arr = array_count_values($id_prod_panier);

        foreach($panier as $produit) {

            if ($produit[0]->getStock() < ($arr[$id])) {
                $error = "Il n'y a pas assez de stock de ".$produit[0]->getNom()." pour finaliser votre commande.";
            }
        }


        foreach($panier as $produit) {
            foreach($produit as $prod) {
                array_push($produits, $prod);
                $total += $prod->getPrix();
            }
        }
            
        $user = $this->getUser();

        return $this->render('home/show_panier.html.twig', [
            "produits" => $produits,
            "user" => $user,
            "total" => $total,
            "error" => $error
        ]);
    }

    /**
     * @Route("/payer", name="payer")
     */
    public function payer(EntityManagerInterface $em)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $panier_user = $em->getRepository(Panier::class)->findBy(array('id_user'=> $user->getId()));

        $panier = [];
        $produits = [];
        $total = 0;

        foreach($panier_user as $produit) {

            $id = $produit->getIdProduit();

            $prod = $this->getDoctrine()
                ->getRepository(Produit::class)
                ->findBy(array('id'=> $id));

            array_push($panier, $prod);

            $em->remove($produit);

        }

        foreach($panier as $produit) {
            foreach($produit as $prod) {
                array_push($produits, $prod);
                $total += $prod->getPrix();

                $prod->setStock($prod->getStock() - 1);

                $vente = new Ventes();

                $vente->setIdUser($user->getId())
                    ->setIdProduit($prod->getId())
                    ->setDate(new \DateTime());


                $em->persist($vente);
                $em->persist($prod);
            }
        }
            
        

        $user->setSolde($user->getSolde() - $total);
        $user->setDepenseAvantBonAchat($user->getDepenseAvantBonAchat() - $total);

        $em->persist($user);
        $em->flush();


        $to = "gauthier.michon@gmail.com" ;
        $subject = "Toby&Fifi - Payement effectué" ;
        $message = "Vous avez payé $total €. Merci de votre achat." ;
        $headers = "From: projetwebynov@gmail.com";


        mail($to, $subject, $message, $headers) ;
        



        return new RedirectResponse('/home_user');


        return $this->render('home/show_panier.html.twig', [
            "produits" => $produits,
            "user" => $user,
            "total" => $total
        ]);
    }
}
