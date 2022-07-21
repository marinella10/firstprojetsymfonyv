<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="app_produits_index")
     * @param ProduitsRepository $produitsRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ProduitsRepository $produitsRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $pagination = $paginator->paginate(
            $produitsRepository->findAll(),
            $request->query->getInt('page', 1), 3
        );

        return $this->render('produits/index.html.twig', [
            'userProduit' => $produitsRepository->findAll(),
            'dernierProduit' => $produitsRepository->getDernierProduit(),
            'pagination' => $pagination,

        ]);
    }

    /**
     * @Route("/new", name="app_produits_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Récupération de la propriété privée  de l'image dans l'entité
            $file = $form["image_produit"]->getData();

            //Di la valeur du champ n'est pas de type chaine de caractère

            if (!is_string($file)) {

                // On récupère le nom du fichier uploader
                $fileName = $file->getClientOriginalName();

                //deplacement de la photo= move_uploaded_file($_FILES['userfile'] ['tmp_name'] en php
                $file->move(
                //Destination du fichier configurer dans le dossier config/services.yaml => parameters
                //images_directory: '@kermel.project_dir%/public/img'
                //Ajouter la ligne a parameters : images_directory: '%kermel.project_dir%/public/image/
                // En second paramètre = le nom du fichier
                    $this->getParameter("images_directory"),
                    $fileName
                );
                // Attribution de la photo a l'entité à l'aide des setters
                $produit->setImageProduit($fileName);
                //Notification flash bag
                $this->addFlash('success', 'Votre annonce à bien été ajouté!');
            } else {
                // Sinon notif d'erreur
                $this->addFlash('danger', 'Une erreur est survenue durant la création de votre annonce !');
                // Redirection vers la page ajouter produits
                return $this->redirect($this->generateurl('app_produits_new'));
            }

            //La requête DQL INSERT INTO

            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_produits_show", methods={"GET"})
     */
    public function show(Produits $produit): Response
    {
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_produits_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        //Récup de la photo courante
        //Recup de l'image avec le getter
        $img = $produit->getImageProduit();

        //Creation du formulaire
        //En paramètre on passe le formulaire ProduiteType et en 2nd l'entité

        $form = $this->createForm(ProduitsType::class, $produit);

        //Récupation des champs (input) du formulaire d'édition

        $form->handleRequest($request);

        //Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            //Traitement du fichier upload
            $file = $form['image_produit']->getData();

            if (!is_string($file)) {
                $fileName = $file->getClientOriginalName();
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $produit->setImageProduit($fileName);
                $this->addFlash('success', 'Votre photo à bien modifiée !');
            } else {
                $produit->setImageProduit($img);
            }

            //DQL UPDATE et sauvegarde
            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_produits_delete", methods={"POST"})
     */
    public function delete(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->request->get('_token'))) {
            $produitsRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }

}





