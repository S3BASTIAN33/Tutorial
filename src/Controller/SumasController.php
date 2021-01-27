<?php

namespace App\Controller;

use App\Repository\ClienteRepository;
use App\Repository\ContratosRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SumasController extends AbstractController
{
    /**
     * @Route("/sumas", name="sumas")
     */
   
    public function busqueda(){
        print("Ingrese fechas ");
        $formulario= $this->createFormBuilder()
        ->setAction($this->generateUrl('sumabusqueda'))
        ->add('FechaInicio', DateType::class, [
    'widget' => 'single_text',
])
        ->add('FechaFinal', DateType::class, [
    'widget' => 'single_text', 
])
        ->add('Buscar', SubmitType::class, ['attr'=>['class'=>'btn btn-primary']])
        
        ->getForm();
        

       
        return $this->render('sumas/index.html.twig', ['formulario'=> $formulario->createView()]);
      
    }
      /**
     * @Route("/sumabusqueda", name="sumabusqueda")
     * @param Request $request
     */
    public function corebusqueda(Request $request, ContratosRepository $coRe){
   $fei=$request->request->get('form')['FechaInicio'];
 
   $fef=$request->request->get('form')['FechaFinal'];
  
  
     $em=$this->getDoctrine()->getManager();
  
      
        $buse= $coRe->busfe($fei,$fef);  
         
    // dump($buse);die;
     
       return $this->render('sumas/sima.html.twig', ['buse' => $buse]);
      
      }

    }
