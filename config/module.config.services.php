<?php
return array(
    'abstract_factories' => array(
        'GfiCommons\ServiceFactory\RepositoryAbstractFactory',
    ),
    'aliases' => array(
        'log' => 'GfiCommons\Factory\LogFactory',
        'ArrayFilter' => 'GfiCommons\Filter\ArrayFilter',
    ),

    'invokables' => array(
        /* filter */
        'GfiCommons\Filter\ArrayFilter' => 'GfiCommons\Filter\ArrayFilter',
    ),

    'factories' => array(
        'GfiCommons\Factory\LogFactory'  => 'GfiCommons\Factory\LogFactory',
    ),
);
