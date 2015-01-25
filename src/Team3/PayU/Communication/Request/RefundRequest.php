<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace Team3\PayU\Communication\Request;

use Team3\PayU\Communication\Request\Model\RefundRequestModel;

class RefundRequest extends AbstractPayURequest
{
    /**
     * @param RefundRequestModel $refundRequestModel
     */
    public function __construct(RefundRequestModel $refundRequestModel)
    {
        $this->data = $refundRequestModel;
        $this->path = sprintf('orders/%s/refund', $this->data->getOrderId());
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return self::METHOD_POST;
    }
}
