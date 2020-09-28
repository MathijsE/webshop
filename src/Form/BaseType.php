<?php

namespace App\Form;

use App\Entity\Base;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bedrijfsnaam')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label_format' => "Image",
                'label' => "Image",
                'download_link' => true,
                'allow_delete' => true,
                'asset_helper' => true,
                'empty_data' => $builder->getForm()->getData('blog')->getImageFile(),
                //  'download_uri' => '...',
                'download_label' => 'download_file',
                'attr' => [
                    'height' => 150,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Base::class,
        ]);
    }
}
