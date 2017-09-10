<?php

namespace ToyBundle\Form;

//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
//use RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle;

class ToyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('detail', TextType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('status', TextType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('picture', FileType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('type', TextType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('date', DateType::class, array( 'attr' => array( 'class' => 'form-control') ))
        ->add('userId', TextType::class, array( 'attr' => array( 'class' => 'form-control') ));

        //ladybug_dump($builder); die;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ToyBundle\Entity\Toy'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'toybundle_toy';
    }


}
