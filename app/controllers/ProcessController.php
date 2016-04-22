<?php

class ProcessController extends \BaseController {

    public function index() {
        
    }

    public function payment() {
        Conekta::setApiKey("key_yTYX8yhYQb9s3DxxNj33zg");

        try {
            //dd($_POST['telefono']);
            $charge = Conekta_Charge::create(array(
                'description'=> '\'Semana de prueba Meridia\'',
                'reference_id'=> $_POST['conektaTokenId'],
                'amount'=> 300000,
                'currency'=>'MXN',
                'card'=> 'tok_test_visa_4242',
                'details'=> array(
                    'name'=> $_POST['nombre'],
                    'phone'=> $_POST['telefono'],
                    'email'=> $_POST['email'],
                    'line_items'=> array(
                        array(
                            'name'=> 'CENTRO MERIDIA ',
                            'description'=> 'Meridia ® ES El Mejor Centro de Día en México estafa Metodología Operativa comprobada Que Mejora de la Calidad de Vida, denominada Método Gerocare ©, ofreciendo Soluciones de Atención integral Para Adultos Mayores y Sus Familiares',
                            'unit_price'=> 300000,
                            'quantity'=> 1,
                            'category'=> 'salud'
                        )
                    )
                )
            ));
        } catch (Conekta_Error $e) {
           return View::make('payment',array('message'=>$e->getMessage()));
        }
        return View::make('payment',array('message'=>$charge->status));
        
    }

}
