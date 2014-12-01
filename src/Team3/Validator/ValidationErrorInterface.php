<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\Validator;

interface ValidationErrorInterface
{
    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return object
     */
    public function getObject();

    /**
     * @return string
     */
    public function getParameter();
}
