<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\kustra88KalkulatorType;
use kustra88\Tools\Kalkulator;
class kustra88KalkulatorController extends Controller
{
    /**
     * @Route("/kustra88/kalkulator/show/form", name="kustra88_kalkulator_show_form")
     */
    public function showFormAction()
    {
        $kalkulator = new Kalkulator();
        $form = $this->createCreateForm($kalkulator);
        return $this->render(
            'AppBundle:kustra88Kalkulator:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("/kustra88/kalkulator/calc", name="kustra88_kalkulator_wynik")
     * @Method("POST")
     */
    public function calculateAction(Request $request)
    {
        $kalkulator = new Kalkulator();
        $form = $this->createCreateForm($kalkulator);
        $form->handleRequest($request);
        if ($form->isValid()) {
            return $this->render(
                'AppBundle:kustra88Kalkulator:wynik.html.twig',
                array('wynik' => $kalkulator->add())
            );
        }
        return $this->render(
            'AppBundle:kustra88Kalkulator:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * Creates a form...
     *
     * @param Kalkulator $kalkulator The object
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Kalkulator $kalkulator)
    {
        $form = $this->createForm(new kustra88KalkulatorType(), $kalkulator, array(
            'action' => $this->generateUrl('kustra88_kalkulator_wynik'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Oblicz'));
        return $form;
    }
}