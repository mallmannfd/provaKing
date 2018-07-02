<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 30/06/18
 * Time: 18:06
 */

namespace Unipago\model;


class Cabecalho
{
    private $empresa;

    private $banco;

    /**
     * @var \DateTime
     */
    private $data;

    public function __construct(string $cabecalho)
    {
        $this->setEmpresa($cabecalho);
        $this->setBanco($cabecalho);
        $this->setData($cabecalho);
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = substr($empresa, 46, 30);
    }

    /**
     * @return mixed
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * @param mixed $banco
     */
    public function setBanco($banco)
    {
        $this->banco = substr($banco, 79, 15);
    }

    /**
     * @return mixed
     */
    public function getData(): \DateTime
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = \DateTime::createFromFormat('dmy', substr($data, 94, 6));
    }
}
