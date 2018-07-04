<?php

use Unipago\model\Cabecalho;
use Unipago\tests\BaseTestCase;

/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 17:58
 */

class CabecalhoTest extends BaseTestCase
{
    /**
     * @var Cabecalho
     */
    protected $cabecalho;

    public function setUp()
    {
        parent::setUp();
        $this->cabecalho = new Cabecalho($this->linhaCabecalho);
    }

    public function testGetData()
    {
        $date = DateTime::createFromFormat('dmy', '030118');
        $this->assertEquals($date, $this->cabecalho->getData(), 'Mensagem não está em formato DateTime');
    }

    /**
     * @expectedException Exception
     * @expectedException Formato de data inválido
     */
    public function testDeveGerarExceptionPorNaoSerDataNoFormatoValido()
    {
        $this->cabecalho->setData('2018-04-16');
    }

    public function testGetBanco()
    {
        $this->assertEquals('BANCO ITAU S.A.', $this->cabecalho->getBanco(), 'Banco incorreto');
    }

    public function testGetEmpresa()
    {
        $this->assertEquals('UNIPAGO SOLUCOES COBRANCA LTDA', $this->cabecalho->getEmpresa(), 'Empresa incorreta');
    }
}
