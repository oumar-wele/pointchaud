<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('imageFile', VichImageType::class, [
                'label'=> 'Image(JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'delete_label' => "Supprimer?",
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
                'imagine_pattern'=> 'my_thumb_small'
            ])
            ->add('title',null,['label'=>'Titre'])
            ->add('prix')
            ->add('localisation',null,["label"=>"ou se trouve votre Annonce?"])
            ->add('description')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
