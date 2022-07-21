<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Distributeur;
use App\Entity\Produits;


use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


// Ceci est un formulaire
class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //<input type="text"/>
            ->add('nom_produit', TextType::class)
            ->add('description_produit', TextareaType::class)
            ->add('image_produit', FileType::class,[
                'label' => 'Image de l\'annonce',
                'required'=> false,
                'data_class'=> null,
                'empty_data' => 'Aucune image pour ce produit!'

            ])
            ->add('stock_produit', CheckboxType::class)
            ->add('date_produit', DateType::class)
            ->add('prix_produit', NumberType::class)


            //Ceci est un formulaire imbriqué
                //on appelle form /reference tpye form
            ->add('numero', ReferencesType::class,[
                'label' => 'Reference du produit'
            ])

            ->add ('distributeur', EntityType::class,[
                'class' => Distributeur::class,
                'choice_label' => 'nomDistributeur',
                'label' => 'Selectionnez un ou plusieur distributeurs',
                'multiple' => true])


            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'nomCategorie',
                'label' => 'Catégorie de l\'annonce ',
                'required' => true
            ])

            ->add('utilisateurs', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'email',
                'label' => 'Selectionnez le vendeur',
            ]);




    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
