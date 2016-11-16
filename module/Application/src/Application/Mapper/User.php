<?php
namespace Application\Mapper;

use Doctrine\ORM\EntityRepository;


class User extends EntityRepository
{
    public function myFindAll($champ = false, $order = false){
        // Nous recherchons les champs de l'entité user pour la gestion des alias cf l.18
        $mapping = $this->getClassMetadata();
        $fieldNames = $mapping->getFieldNames();
//        var_dump($fieldNames);exit;
        
        $select = $this->createQueryBuilder('u')
                ->innerJoin('Application\Entity\Profile', 'p', 'WITH', 'p.id = u.profile');
            
        // En raison de la notion d'alias dans le orderBY, 
        // nous regardons si le champ est contenu dans l'entité user afin d'attriuer l'alias correct au champ
        // Sinon nous sommes dans l'entité profile
        if(in_array($champ, $fieldNames)){
            $alias_champ = 'u.'.$champ;
        }
        else{
            $alias_champ = 'p.'.$champ;
        }
        
        // Si un tri est effectué nous appliquons la notion orderBy
        if($champ && $order) 
            $select->orderBy($alias_champ, $order);
        
        return $select->getQuery()->getResult();       
    }
}