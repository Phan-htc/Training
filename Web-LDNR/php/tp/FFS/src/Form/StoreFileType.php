<?php

    namespace App\Form;

    use App\Entity\StoreFile;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\File;

    class StoreFileType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
            ->add('pathCSV', FileType::class, [
                'label' => 'Chemin du fichier CSV',
                'constraints' => [
                    new File([
                        'maxSize' => '16k',
                        'mimeTypes' => [
                            'text/plain',
                            'application/csv',
                        ],
                        'mimeTypesMessage' => 'Chargez un fichier valide',
                    ])
                ],
            ])
            ->add('pathZIP', FileType::class, [
                'label' => 'Chemin du fichier ZIP',
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'application/zip'
                        ],
                        'mimeTypesMessage' => 'Chargez un fichier valide',
                    ])
                ],
            ])
        ->add('send', SubmitType::class, ['label' => 'Envoyer']);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => StoreFile::class,
            ]);
        }
    }
