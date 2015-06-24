<?php

namespace Fw\Component\View;

interface View {

    public function render($data='', $headers=null);
}