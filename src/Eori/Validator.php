<?php

namespace Slimad\Eori\Eori;

use Exception;
use SoapClient;
use SoapFault;

class Validator
{
    private const WSDL_URL = 'https://ec.europa.eu/taxation_customs/dds2/eos/validation/services/validation?wsdl';

    private bool $valid = false;

    private bool $strict = true;

    private function getEcClient(): SoapClient
    {
        ini_set('default_socket_timeout', 3);
        ini_set('max_execution_time', 30);

        return new SoapClient(self::WSDL_URL, [
            'connection_timeout' => 3,
            'exceptions' => true,
        ]);
    }

    /**
     * Get Valid.
     */
    private function getValid(): bool
    {
        return $this->valid;
    }

    private function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }

    public function getStrict(): bool
    {
        return $this->strict;
    }

    public function setStrict(bool $strict): void
    {
        $this->strict = $strict;
    }

    public function isValid(): bool
    {
        return $this->getValid();
    }

    public function validate(string $eoriNumber): bool
    {
        try {
            $ecClient = $this->getEcClient();

            $response = $ecClient->validateEORI([
                'eori' => $eoriNumber,
            ]);

            if ($response->return->result->statusDescr !== 'Valid') {
                $this->setValid(false);

                return false;
            }

            $this->setValid(true);

            return true;
        } catch (SoapFault $e) {
            if (! $this->getStrict()) {
                $this->setValid(true);

                return true;
            }

            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
