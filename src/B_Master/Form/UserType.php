<?php
// src/B_Master/Form/UserType.php
namespace App\B_Master\Form;

use App\B_Master\Model\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(child: 'username', type: TextType::class, options: [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(exactly: ['min' => 3, 'max' => 20]),
                    new Assert\Regex(pattern: [
                        'pattern' => '/^[a-zA-Z0-9_]+$/',
                        'message' => 'Seulement lettres, chiffres et underscore autorisés.',
                    ]),
                ],
            ])
            ->add(child: 'pseudo', type: TextType::class, options: [
                'required' => false,
                'constraints' => [
                    new Assert\Length(exactly: ['max' => 30]),
                ],
            ])
            ->add(child: 'password', type: PasswordType::class, options: [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(exactly: ['min' => 4]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(defaults: [
            'data_class' => User::class,
        ]);
    }
}
