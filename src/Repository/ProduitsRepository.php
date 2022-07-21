<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produits>
 *
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    public function add(Produits $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produits $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Mettre un produit en vedette custom DQL

    public function getDernierProduit()
    {
        //Ici on creer une variable qui appel la methode createQueryBuilder de Doctrine et prend un alias en paramètre
        //De cette manière pas besoin d'ecrire de SQL classique
        //A noter que PHP permet de chainer les methodes
        $dernierProduit = $this->createQueryBuilder('p')
            //On utilise l'alias p pour recup id et trier par order decroissant
            ->orderBy('p.id', 'DESC')
            //Un seul element
            ->setMaxResults(1)
            //Parcours des resultats
            ->getQuery()
            //getOneOrNullResult() = recupère un objet ou une valeur null (erreur si plusieurs objet)
            ->getOneOrNullResult();

        //retourne le resultat de ma requète
        return $dernierProduit;
    }


    /*// Trier les annonces par prix et mot cle
// cette méthode est appelée dans RechercherController
public function getMinMaxPrice($prixMin,$prixMax){
    //Création du queryBuilder + alias de entité annonces
    $query = $this->createQueryBuilder('produits');

    //Si les 2 champs sont templis
    if ($prixMin && $prixMax){
        $query
            ->addWhere('produits.prix_produit BETWEEN :prixmin AND :prixmax')
            ->setParameter(prixMin, $prixMin)
            ->setParameter('prixmax', $prixMax);
    }
    return $query->getQuery()->getResult();
}
    */


//    /**
//     * @return Produits[] Returns an array of Produits objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produits
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}


