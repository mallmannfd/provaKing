<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 30/06/18
 * Time: 18:06
 */

namespace Unipago\model;


class Cabecalho extends BaseModel
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
     * @return string
     */
    public function getEmpresa(): string
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
     * @return string
     */
    public function getBanco(): string
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
     * @return \DateTime
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
