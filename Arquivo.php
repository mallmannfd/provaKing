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

    private function setCabecalho(&$file): void
    {
        $this->cabecalho = new Cabecalho($file[0]);
        array_shift($file);
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
            $nosso_numero = substr($titulo, 62, 8);
            $valorPago = substr($titulo, 152, 13) / 100;
            $tarifa = substr($titulo, 175, 13) / 100;
            $juros = substr($titulo, 266, 13) / 100;
            $creditado = substr($titulo, 253, 13) / 100;
            $ocorrencia = substr($titulo, 108, 2);

            $arrayOcorrencias = array('06','09');

            if (in_array($ocorrencia, $arrayOcorrencias)) {
                if (number_format($creditado,2) == number_format($valorPago + $juros - $tarifa, 2)) {
                    echo "Pagamento do título $nosso_numero efetuado com sucesso \n";
                    ApiPagamentos::baixaTitulo($nosso_numero, $valorPago);
                } else {
                    echo "Valor incorreto \n";
                }
            } else {
                echo "Tipo de entrada não encontrado \n";
            }
        }
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
