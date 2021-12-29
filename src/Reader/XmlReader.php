<?php

declare(strict_types=1);

namespace App\Reader;

use SimpleXMLElement;

class XmlReader extends AbstractReader
{
    /**
     * @throws
     */
    public function read(): array
    {
        $xml = new SimpleXMLElement($this->file->fread($this->file->getSize()));
        return json_decode(json_encode((array) $xml), true)['item'];
    }
}
