<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 30/06/18
 * Time: 17:34
 */

namespace Unipago\model;


use Unipago\ApiPagamentos;

class Arquivo
{
    /**
     * @var Cabecalho
     */
    private $cabecalho;

    private $corpo;

    private $rodape;

    public function __construct(string $fileContents)
    {
        $file = explode("\n", $fileContents);
        $this->setCabecalho($file);
        $this->setRodape($file);
        $this->setCorpo($file);
    }

    public function getCabecalho(): Cabecalho
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

    public function validaEmpresa()
    {
        if (strtolower(trim($this->cabecalho->getEmpresa())) != 'unipago solucoes cobranca ltda') {
            throw new \Exception("Arquivo não é referente a empresa correta.");
        }

        echo 'Arquivo válido'."\n";
    }

    public function processaTitulos()
    {
        foreach ($this->corpo as $titulo){
            $titulo->processa();
        }
    }

    public function validaImportacao()
    {
        $valorTotal = substr($this->rodape, 220, 14) / 100;

        $totalDoArquivo = 0;
        for ($i=0; $i < count($this->corpo); $i++) {
            $totalDoArquivo += $this->corpo[$i]->getValorPago();
        }

        if (number_format($valorTotal, 2) != number_format($totalDoArquivo, 2)) {
            throw new \Exception("Arquivo inconsistente");
        } else {
            echo "arquivo importado com sucesso \n";
        }
    }

    private function setCabecalho(&$file): void
    {
        $this->cabecalho = new Cabecalho($file[0]);
        array_shift($file);
    }

    private function setRodape(&$file): void
    {
        while (empty(end($file))){
            array_pop($file);
        }
        $this->rodape = end($file);
        array_pop($file);
    }

    private function setCorpo($file): void
    {
        $titulos = [];
        foreach ($file as $line){
            $titulo = new Titulo($line);
            $titulos[] = $titulo;
        }

        $this->corpo = $titulos;
    }
}
