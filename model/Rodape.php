<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 02/07/18
 * Time: 21:17
 */

namespace Unipago\model;


class Rodape extends BaseModel
{
    private $valorTotal;

    /**
     * Rodape constructor.
     * @param $valorTotal
     */
    public function __construct($linha)
    {
        $this->setValorTotal($linha);
    }

    /**
     * @return float
     */
    public function getValorTotal(): float
    {
        return $this->valorTotal;
    }

    /**
     * @param $linha
     */
    public function setValorTotal($linha)
    {
        $this->valorTotal = substr($linha, 220, 14) / 100;
    }

}
