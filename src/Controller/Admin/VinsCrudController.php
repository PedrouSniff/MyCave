<?php

namespace App\Controller\Admin;

use App\Entity\Vins;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class VinsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vins::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('description'),
            DateField::new('date'),
            AssociationField::new('region','region'),
            ImageField::new('imageName')
            ->setBasePath('images')
            ->setUploadDir('public/images/'),        
        ];
    }
}
