<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 17:36
 */
namespace Unipago\tests;

use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected $linhaCabecalho;

    protected $linhaCorpo;

    protected $linhaRodape;

    public function setUp()
    {
        $this->linhaCabecalho = '0000000000000000000       000000000000        UNIPAGO SOLUCOES COBRANCA LTDA000BANCO ITAU S.A.0301180000000000000000000                                                                                                                                                                                                                                                                                   000001';
        $this->linhaCorpo = '10000000000000000000000000000        000000                   61000001            000000000000             I060000000000000   00000000            00000000000000085000000000000000000000012500000000000000000000000000000000000000000000000000000000000000000000000000886800000000004930000000000000   03011800000000000000000000000NOME DO CLIENTE                                                     AA000002';
        $this->linhaRodape = '9000000          000000000000000000000000000000          000000000000000000000000000000                                                  000000000000000000000000000000          0000000000000000000000  000000000000000000000000000008500                                                                                                                                                                000040';
    }

}
