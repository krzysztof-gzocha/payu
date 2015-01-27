<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */
namespace Team3\PayU\Communication\Process\NotificationProcess;

use Team3\PayU\Communication\Notification\OrderNotification;
use Team3\PayU\Configuration\Credentials\CredentialsInterface;
use Team3\PayU\Serializer\SerializerInterface;
use Team3\PayU\SignatureCalculator\Validator\SignatureValidatorInterface;

class NotificationProcess
{
    const ORDER_NOTIFICATION_CLASS = 'Team3\PayU\Communication\Notification\OrderNotification';

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var SignatureValidatorInterface
     */
    private $signatureValidator;

    /**
     * @param SerializerInterface         $serializer
     * @param SignatureValidatorInterface $signatureValidator
     */
    public function __construct(
        SerializerInterface $serializer,
        SignatureValidatorInterface $signatureValidator
    ) {
        $this->serializer = $serializer;
        $this->signatureValidator = $signatureValidator;
    }

    /**
     * @param CredentialsInterface $credentials
     * @param string               $data
     * @param string|null          $signatureHeader Signature can be null when notifyUrl starts with https
     *
     * @return OrderNotification
     */
    public function process(
        CredentialsInterface $credentials,
        $data,
        $signatureHeader = null
    ) {
        if (null !== $signatureHeader) {
            $this->validateSignature($credentials, $data, $signatureHeader);
        }

        return $this
            ->serializer
            ->fromJson($data, self::ORDER_NOTIFICATION_CLASS);
    }

    /**
     * @param CredentialsInterface $credentials
     * @param string               $data
     * @param string               $signatureHeader
     *
     * @throws NotificationProcessException
     */
    private function validateSignature(
        CredentialsInterface $credentials,
        $data,
        $signatureHeader
    ) {
        $isSignatureValid = $this
            ->signatureValidator
            ->isSignatureValid(
                $data,
                $signatureHeader,
                $credentials
            );

        if (!$isSignatureValid) {
            throw new NotificationProcessException(sprintf(
                'Signature header "%s" for data "%s" is not correct.',
                $signatureHeader,
                $data
            ));
        }
    }
}
