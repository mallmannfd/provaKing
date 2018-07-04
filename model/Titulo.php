<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 02/07/18
 * Time: 20:51
 */

namespace Unipago\model;


use Unipago\ApiPagamentos;

class Titulo extends BaseModel
{
    const OCORRENCIAS = ['06', '09'];

    private $nossoNumero;

    private $valorPago;

    private $tarifa;

    private $juros;

    private $creditado;

    private $ocorrencia;

    public function __construct($titulo)
    {
        parent::__construct();
        $this->setNossoNumero($titulo);
        $this->setValorPago($titulo);
        $this->setTarifa($titulo);
        $this->setJuros($titulo);
        $this->setCreditado($titulo);
        $this->setOcorrencia($titulo);
    }

    /**
     * @return int
     */
    public function getNossoNumero(): int
    {
        return $this->nossoNumero;
    }

    /**
     * @param mixed $nossoNumero
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = substr($nossoNumero, 62, 8);
    }

    /**
     * @return float
     */
    public function getValorPago(): float
    {
        return $this->valorPago;
    }

    /**
     * @param mixed $valorPago
     */
    public function setValorPago($valorPago)
    {
        $this->valorPago = substr($valorPago, 152, 13) / 100;
    }

    /**
     * @return float
     */
    public function getTarifa(): float
    {
        return $this->tarifa;
    }

    /**
     * @param mixed $tarifa
     */
    public function setTarifa($tarifa)
    {
        $this->tarifa = substr($tarifa, 175, 13) / 100;
    }

    /**
     * @return float
     */
    public function getJuros(): float
    {
        return $this->juros;
    }

    /**
     * @param mixed $juros
     */
    public function setJuros($juros)
    {
        $juros = substr($juros, 266, 13);

        if (intval($juros) != 0){
            $juros = $juros  / 100;
        }

        $this->juros = $juros;
    }

    /**
     * @return float
     */
    public function getCreditado(): float
    {
        return $this->creditado;
    }

    /**
     * @param mixed $creditado
     */
    public function setCreditado($creditado)
    {
        $creditado = substr($creditado, 253, 13);
        if (intval($creditado) != 0){
            $creditado = $creditado / 100;
        }

        $this->creditado = $creditado;
    }

    /**
     * @return int
     */
    public function getOcorrencia(): int
    {
        return $this->ocorrencia;
    }

    /**
     * @param mixed $ocorrencia
     */
    public function setOcorrencia($ocorrencia)
    {
        $this->ocorrencia = substr($ocorrencia, 108, 2);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function processa(): bool
    {
        if (false == in_array($this->ocorrencia, self::OCORRENCIAS)) {
            throw new \Exception("Tipo de entrada não encontrado \n");
        }

        if (number_format($this->creditado,2) != number_format($this->valorPago + $this->juros - $this->tarifa, 2)){
            throw new \Exception("Valor incorreto \n");
        }

        $this->reportLogger->info("Pagamento do título $this->nossoNumero efetuado com sucesso");
        echo "Pagamento do título $this->nossoNumero efetuado com sucesso \n";
        ApiPagamentos::baixaTitulo($this->nossoNumero, $this->valorPago);
    }
}
