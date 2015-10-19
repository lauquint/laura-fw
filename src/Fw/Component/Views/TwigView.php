<?php

namespace Fw\Component\Views;

use Fw\Component\Views\View;
use Fw\Component\Views\WebView;
use \Twig_Environment;

class TwigView implements WebView, View {

    public $twig_view;

    public function __construct(Twig_Environment $twig) {
       $this->twig_view = $twig;

    }

    public function render($data=array()) {

        return $this->twig_view->render($data['template'], $data['parameters']);

    }

}