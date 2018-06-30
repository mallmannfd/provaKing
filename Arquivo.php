<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 30/06/18
 * Time: 17:34
 */

namespace Unipago;


class Arquivo
{
    private $cabecalho;

    private $corpo;

    private $rodape;

    public function __construct($fileContents)
    {
        $file = explode("\n", $fileContents);
        $this->setCabecalho($file);
        $this->setRodape($file);
        $this->setCorpo($file);
    }

    public function getCabecalho(): string
    {
        return $this->cabecalho;
    }

    public function getCorpo(): array
    {
        return $this->corpo;
    }

    public function getRodape(): string
    {
        return $this->rodape;
    }

    private function setCabecalho(&$file): void
    {
        $this->cabecalho = $file[0];
        array_shift($file);
    }

    private function setRodape(&$file): void
    {
        while (empty(end($file))){
            array_pop($file);
        }
        $this->rodape = end($file);
    }

    private function setCorpo($file): void
    {
        $this->corpo = $file;
    }
}
