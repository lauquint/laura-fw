<?php

namespace Fw\Component\Views;

use Fw\Component\Views\View;
use Fw\Component\Views\WebView;
use \Twig_Environment;

class TwigView implements WebView, View {


    public function __construct(Twig_Environment $twig) {
       $twig = $this->twig;

    }

    public function render($data=array()) {

        echo $this->twig->render($data['template'], $data['parameters']);

    }


}