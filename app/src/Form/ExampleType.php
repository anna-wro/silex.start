<?php
/**
 * Example type.
 */
namespace Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ExampleType.
 *
 * @package Form
 */

class ExampleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => true,
                'attr' => [
                    'max_length' => 128,
                    'class' => 'input__title'
                ],
                'constraints' => [
                    new Assert\NotBlank(
                        ['groups' => ['example-default']]
                    ),
                    new Assert\Length(
                        [
                            'groups' => ['example-default'],
                            'min' => 3,
                            'max' => 128,
                        ]
                    ),
                ],
            ]
        );
        $builder->add(
            'url',
            UrlType::class,
            [
                'label' => 'label.url',
                'required' => true,
                'attr' => [
                    'max_length' => 128,
                    'class' => 'input__url'
                ],
                'constraints' => [
                    new Assert\NotBlank(
                        ['groups' => ['example-default']]
                    ),
                    new Assert\Length(
                        [
                            'groups' => ['example-default'],
                            'min' => 3,
                            'max' => 128,
                        ]
                    ),
                ],
            ]
        );
        $builder->add(
            'is_public',
            ChoiceType::class,
            [
                'label' => 'label.is_public',
                'choices'  => [
                    'label.no' => 0,
                    'label.yes' => 1,
                ],
                'required' => true,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'example_type';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'validation_groups' => 'example-default',
            ]
        );
    }
}