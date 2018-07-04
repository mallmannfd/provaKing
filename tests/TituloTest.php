<?php
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 17:02
 */

use PHPUnit\Framework\TestCase;
use Unipago\model\Titulo;

class TituloTest extends TestCase
{
    protected $linha;
    /**
     * @var Titulo
     */
    protected $titulo;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->linha = '10000000000000000000000000000        000000                   61000001            000000000000             I060000000000000   00000000            00000000000000085000000000000000000000012500000000000000000000000000000000000000000000000000000000000000000000000000886800000000004930000000000000   03011800000000000000000000000NOME DO CLIENTE                                                     AA000002';
        $this->titulo = new Titulo($this->linha);
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
