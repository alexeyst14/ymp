<?php

namespace Avkdev\YmParserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Avkdev\YmParserBundle\Entity\CategoryRepository;

class TaskType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add(
                'category',
                'entity',
                array(
                    'class' => 'Avkdev\YmParserBundle\Entity\Category',
                    'query_builder' => function (CategoryRepository $r) {
                        return $r->createQueryBuilder('c');
                    },
                    'required' => true,
                )
            );
        $builder->add('runDate', null, array('data' => new \DateTime()));
//        $builder->add('isRepeat', 'checkbox', array(
//                'required' => false
//            ));
        // $builder->add('status');
        // $builder->add('progressStatus');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Avkdev\YmParserBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'avkdev_ymparserbundle_task';
    }
}
