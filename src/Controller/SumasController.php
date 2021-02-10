<?php

namespace App\Controller;

use App\Repository\ClienteRepository;
use App\Repository\ContratosRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;

class SumasController extends AbstractController
{
    /**
     * @Route("/sumas", name="sumas")
     */
   
    public function busqueda(){
        print("Ingrese fechas ");
        $formulario= $this->createFormBuilder()
        ->setAction($this->generateUrl('sumabusqueda'))
        ->add('FechaInicio', DateType::class, [ 'widget' => 'single_text',])
        ->add('FechaFinal', DateType::class, ['widget' => 'single_text', ])
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
   $buse= $coRe->busfe($fei,$fef);
   $e=array();
   $copia=$buse; 
  
    $cant=count($copia)-1;
  
 //foreach ($copia as $co) {
   //  $j++;
//}
//$j--;

    for ($i = 0; $i <= $cant; $i++) {
        $e= $copia[$i]["clientes"];
        for ($z = $i; $z <= $cant; $z++) {
            if ($i!=$z && $e==$copia[$z]["clientes"]) {
                $copia[$i]["monto"]=$copia[$i]["monto"]+$copia[$z]["monto"];        
                 $copia[$z]["clientes"]=null;
                 $copia[$z]["monto"]=null;
                
            }     
        }
        
    }   

      return $this->render('sumas/sima.html.twig', ['copia' => $copia]);
      }
    }
