<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(EntityManagerInterface $em): Response
    {


        $user = $this->getUser();

        if (!empty($user)) {
            if ($user->getRoles()[0] == "ROLE_USER") {
                return new RedirectResponse('/home');
            }
        }
        else {
            return new RedirectResponse('/home');
        }

        $date = (new \DateTime());
        $date->modify('-7 day');
        $total_prix_7 = 0;
        $total_ventes_7 = 0;
        $total_prix = 0;
        $total_ventes = 0;
        $total_membres = 0;
        

        $query_ventes_7 = $em->createQuery(
            'SELECT v
            FROM App\Entity\Ventes v
            WHERE v.date > :date7'
        )->setParameter('date7', $date);
        
        $Ventes_7 = $query_ventes_7->getResult();


        foreach ($Ventes_7 as $vente) {
            $id_prod = $vente->getIdProduit();

            $Produit = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id_prod);

            $total_prix_7 += $Produit->getPrix();
            $total_ventes_7 += 1;

        }


        $query_ventes = $em->createQuery(
            'SELECT v
            FROM App\Entity\Ventes v');

        $Ventes = $query_ventes->getResult();

        foreach ($Ventes as $vente) {
            $id_prod = $vente->getIdProduit();

            $Produit = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id_prod);

            $total_prix += $Produit->getPrix();
            $total_ventes += 1;

        }




        $Users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        foreach ($Users as $user) {
            $total_membres += 1;
        }


        return $this->render('admin/index.html.twig', [
            "user" => $user,
            "total_prix_7" => $total_prix_7,
            "total_ventes_7" => $total_ventes_7,
            "total_prix" => $total_prix,
            "total_ventes" => $total_ventes,
            "total_membres" => $total_membres
        ]);
    }


    /**
     * @Route("/admin_produits", name="admin_produits")
     */
    public function admin_produits(): Response
    {
        $Produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        $user = $this->getUser();

        if (!empty($user)) {
            if ($user->getRoles()[0] == "ROLE_USER") {
                return new RedirectResponse('/home');
            }
        }
        else {
            return new RedirectResponse('/home');
        }


        if (!empty($user)) {
            return $this->render('admin/admin_produits.html.twig', [
                'produits' => $Produits,
                "user" => $user
            ]);
        }

        else {
            return $this->render('admin/index.html.twig', [
                'produits' => $Produits,
            ]);
        }
    }


    /**
     * @Route("/admin_membres", name="admin_membres")
     */
    public function admin_membres(): Response
    {
        $Users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $user = $this->getUser();

        if (!empty($user)) {
            if ($user->getRoles()[0] == "ROLE_USER") {
                return new RedirectResponse('/home');
            }
        }
        else {
            return new RedirectResponse('/home');
        }


        if (!empty($user)) {
            return $this->render('admin/admin_membres.html.twig', [
                'Users' => $Users,
                "user" => $user
            ]);
        }

        else {
            return $this->render('admin/index.html.twig', [
                'Users' => $Users,
            ]);
        }
    }


    /**
     * @Route("/recherche_users", name="recherche_users")
     */
    public function recherche_users(EntityManagerInterface $em)
    {

        $user = $this->getUser();

        if (!empty($user)) {
            if ($user->getRoles()[0] == "ROLE_USER") {
                return new RedirectResponse('/home');
            }
        }
        else {
            return new RedirectResponse('/home');
        }

        $recherche = $_POST['rechercher_users'];

        $query = $em->createQuery(
            'SELECT u
            FROM App\Entity\User u
            WHERE u.email LIKE :recherche'
        )->setParameter('recherche', '%'.$recherche.'%');

        // returns an array of Product objects
        
        $Users = $query->getResult();

        $role = $user->getRoles();

        if (!empty($user)) {
            return $this->render('admin/recherche_users.html.twig', [
                'Users' => $Users,
                "recherche" => $recherche,
                "user" => $user,
                "role" => $role[0]
            ]);
        }

        else {
            return $this->render('admin/recherche_users.html.twig', [
                'Users' => $Users,
                "recherche" => $recherche,
            ]);
        }
    }




    /**
     * @Route("/membre/{id}", name="show_user")
     */
    public function show_user(int $id, User $membre, EntityManagerInterface $em)
    {   

        $user = $this->getUser();

        if (!empty($user)) {
            if ($user->getRoles()[0] == "ROLE_USER") {
                return new RedirectResponse('/home');
            }
        }
        else {
            return new RedirectResponse('/home');
        }

        $role = $user->getRoles();
        

        return $this->render('admin/membre.html.twig', [
            'membre' => $membre,
            "role" => $role[0]
        ]);
    }
}
