<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Entity\Distributeur;
use App\Form\ReferencesType;


use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id','ID')->onlyOnIndex(),
            TextField::new('nomProduit', 'Nom du produits'),
            TextEditorField::new('descriptionProduit', 'Description du produit'),
            NumberField::new('prixProduit', 'prix du produit'),
            ImageField:: new('imageproduit')
            ->setBasePath('/image')
            ->setUploadDir('public/image/')
            ->SetFormType(FileUploadType::class)
            ->setRequired(true),
            BooleanField:: new('stockProduit', 'Produit en stock'),
            DateTimeField::new('DateProduit', 'date de dépot'),
            AssociationField:: new('categories', 'Categorie du produit'),
            AssociationField::new('distributeur', 'Liste des distribtureus'),
            IntegerField::new('numero', 'référence de l\'annonce')
            ->setFormType(ReferencesType::class)
        ];
    }

}
