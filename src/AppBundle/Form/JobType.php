<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;




class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',  ChoiceType::class, array('choices' => JobType::getTypes(), 'expanded' => false))
            ->add('company', TextType::class)
            ->add('logo', FileType::class,array(
                'data_class' => null))
            ->add('url', TextType::class)
            ->add('position', TextType::class)
            ->add('location', TextType::class)
            ->add('description', TextType::class)
            ->add('howToApply', TextType::class)
            ->add('token', TextType::class)
            ->add('isPublic', CheckboxType::class)
            ->add('isActivated', CheckboxType::class)
            ->add('email',EmailType::class)
            ->add('expirestAt',DateType::class)
            ->add('createdAt',DateType::class)
            ->add('updatedAt',DateType::class)
            ->add('idCategory')
            ->getForm();

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Job'
        ));
    }

    public static function getTypes()
    {
      return array('full-time' => 'Full time', 'part-time' => 'Part time', 'freelance' => 'Freelance');
    }
     
    public static function getTypeValues()
    {
      return array_keys(self::getTypes());
    }


}
