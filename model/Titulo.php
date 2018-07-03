<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 02/07/18
 * Time: 20:51
 */

namespace Unipago\model;


class Titulo
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
        $this->setNossoNumero($titulo);
        $this->setValorPago($titulo);
        $this->setTarifa($titulo);
        $this->setJuros($titulo);
        $this->setCreditado($titulo);
        $this->setOcorrencia($titulo);
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
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
     * @return mixed
     */
    public function getValorPago()
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
     * @return mixed
     */
    public function getTarifa()
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
     * @return mixed
     */
    public function getJuros()
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
     * @return mixed
     */
    public function getCreditado()
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
     * @return mixed
     */
    public function getOcorrencia()
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
}
