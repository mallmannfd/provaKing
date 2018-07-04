<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 17:02
 */

use Unipago\model\Titulo;
use Unipago\tests\BaseTestCase;

class TituloTest extends BaseTestCase
{
    /**
     * @var Titulo
     */
    protected $titulo;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        $this->titulo = new Titulo($this->linhaCorpo);
    }

    public function testGetNossoNumero()
    {
        $this->assertEquals('61000001', $this->titulo->getNossoNumero(), 'Nosso número está incorreto');
    }

    public function testGetValorPago()
    {
        $this->assertEquals(85, $this->titulo->getValorPago(), 'Valor pago incorreto');
    }

    public function testGetTarifa()
    {
        $this->assertEquals(1.25, $this->titulo->getTarifa(), 'Tarifa no valor incorreto');
    }

    public function testGetJuros()
    {
        $this->assertEquals(4.93, $this->titulo->getJuros(), 'Juros incorreto');
    }

    public function testGetCreditado()
    {
        $this->assertEquals(88.68, $this->titulo->getCreditado(), 'Valor credato incorreto');
    }

    public function testGetOcorrencia()
    {
        $this->assertEquals("06", $this->titulo->getOcorrencia(), 'Ocorrência inválida');
    }

    public function deveProcessarOcorrenciaDoTitulo()
    {
        $this->assertTrue($this->titulo->processa(), 'Não processou a ocorrência do Título');
    }
}
