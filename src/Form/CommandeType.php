<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
               //  name du champ     type de champ
            ->add('adresseLivraison',TextType::class, [
                'label'=>'Adresse de Livraison :',
                'label_attr' => [
                    'style' => 'white-space: nowrap;',],
                "attr"=>[
                    'class'=>'form-control form-control-lg rounded col-12 '
                ],
                'required'=>true,
            ])
        ->add('adresseFacturation',TextType::class, [
            'label'=>'Adresse de Facturation :',
            'label_attr' => [
                'style' => 'white-space: nowrap;',],
            "attr"=>[
                'class'=>'form-control form-control-lg rounded col-12 ',
            ],             
            "required"=>false,

        ])
        ->add("same", RadioType::class ,[
            "label"=>"L'adresse de livraison et de facturation sont les mêmes.",
            'label_attr' => [
                'style' => 'white-space: nowrap;',],
            "attr"=>[
                "class"=>"form-check-input",
            ],                
            "required"=>false,

        ])
        ->add('MoyenPaiment', ChoiceType::class,[
            "label"=>'Moyen de paiment :',
         
            'label_attr' => [
                'style' => 'white-space: nowrap;',],
            "choices"=>[
                'Carte Bancaire'=>'carte',
                'Paypal'=>'paypal',
            ],
            "expanded"=>true,
            'multiple'=>false,
            'attr'=>[
                'class'=>"form-check-input",
            ],
            'choice_attr'=>[
                'Carte Bancaire'=>['class'=>'mb-2'],
                'Paypal'=>['class'=>'mr-3 mb-2'],
            ],
            'choice_label' => function ($value, $key, $index) {
                if ($value === 'carte') {
                    return ' ' ;
                } elseif ($value === 'paypal') {
                    return ' ' ;
                }
                return $key;
            }
            
            
        ])
        ->add("CGU", RadioType::class ,[
            "label"=>"J'accepte les ",
            'label_attr' => [
                'style' => 'white-space: nowrap;',],
            "attr"=>[
                "class"=>"form-check-input",
            ],                
            "required"=>true,

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
