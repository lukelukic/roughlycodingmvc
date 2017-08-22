<?php

namespace rc\system;

class SystemTwigExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('baseUrl', 'baseUrl'),
            new \Twig_SimpleFunction('flash', 'flash'),
            new \Twig_SimpleFunction('sessGet', 'sessGet')
        );
    }
}