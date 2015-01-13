<?php
// This is global bootstrap for autoloading

// Register annotations
\Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
    __DIR__.'/../src/Team3/Annotation/PayU.php'
);
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'JMS\Serializer\Annotation',
    __DIR__.'/../vendor/jms/serializer/src'
);
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
    'Symfony\\Component\\Validator',
    __DIR__.'/../vendor/symfony/validator'
);
