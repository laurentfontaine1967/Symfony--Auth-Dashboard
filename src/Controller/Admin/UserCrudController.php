<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users')
            ->setSearchFields(['email'])
            ->setDefaultSort(['id' => 'DESC']);
    }


    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            // ->add(EntityFilter::new('user'::class));

            ->add(EntityFilter::new('user')->setFormType(EntityType::class)->setFormTypeOptions([
                'class' => User::class,
                'choice_label' => 'email', // Remplacez 'email' par le champ que vous voulez afficher dans le filtre
            ]));
    }



    public function configureFields(string $pageName): iterable
    {

        // yield AssociationField::new('user');
        yield IdField::new('id');
        yield EmailField::new('email');


        // $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions([
        //     'years' => range(date('Y'), date('Y') + 5),
        //     'widget' => 'single_text',
        // ]);

        // if (Crud::PAGE_EDIT === $pageName) {
        //     yield $createdAt->setFormTypeOption('disabled', true);
        // } else {
        //     yield $createdAt;
        // }
    }
}
