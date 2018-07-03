<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 30/06/18
 * Time: 17:34
 */

namespace Unipago\model;

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

    /**
     * @return Cabecalho
     */
    public function getCabecalho(): Cabecalho
    {
        return $this->cabecalho;
    }

    /**
     * @return array
     */
    public function getCorpo(): array
    {
        return $this->corpo;
    }

    /**
     * @return string
     */
    public function getRodape(): string
    {
        return $this->rodape;
    }

    /**
     * @throws \Exception
     */
    public function validaEmpresa()
    {
        if (strtolower(trim($this->cabecalho->getEmpresa())) != 'unipago solucoes cobranca ltda') {
            throw new \Exception("Arquivo não é referente a empresa correta.");
        }

        echo 'Arquivo válido'."\n";
    }

    /**
     *
     */
    public function processaTitulos()
    {
        foreach ($this->corpo as $titulo){
            $titulo->processa();
        }
    }

    /**
     * @throws \Exception
     */
    public function validaImportacao()
    {
        if (number_format($this->rodape->getValorTotal(), 2) != number_format($this->getValorTotalEmTitulos(), 2)) {
            throw new \Exception("Arquivo inconsistente");
        }

        echo "arquivo importado com sucesso \n";
    }

    /**
     * @return float
     */
    public function getValorTotalEmTitulos(): float
    {
        $totalDoArquivo = 0;
        for ($i=0; $i < count($this->corpo); $i++) {
            $totalDoArquivo += $this->corpo[$i]->getValorPago();
        }
        return $totalDoArquivo;
    }

    /**
     * @param $file
     */
    private function setCabecalho(&$file): void
    {
        $this->cabecalho = new Cabecalho($file[0]);
        array_shift($file);
    }

    /**
     * @param $file
     */
    private function setRodape(&$file): void
    {
        while (empty(end($file))){
            array_pop($file);
        }
        $this->rodape = new Rodape(end($file));
        array_pop($file);
    }

    /**
     * @param $file
     */
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
