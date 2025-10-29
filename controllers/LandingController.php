<?php
class LandingController extends BaseController {
    public function index($twig) {
        $this->render($twig, 'landing.twig');
    }
}
?>