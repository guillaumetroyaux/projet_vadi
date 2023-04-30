<?php

namespace App\Form;

use App\Entity\PhotoProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;



class PhotoProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', FileType::class, [
                'constraints' => [
                    new Assert\Image([
                        'mimeTypes' => ['image/png', 'image/jpeg', 'image/gif'],
                        'maxSize' => '2M',
                        'maxWidth' => 2400,
                        'maxHeight' => 2400,
                    ]),
                ],
            ])
            ->add('enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PhotoProfil::class,
        ]);
    }
}
