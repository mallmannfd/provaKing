<?php

use Unipago\model\Arquivo;
use Unipago\model\Cabecalho;
use Unipago\model\Rodape;
use Unipago\model\Titulo;
use Unipago\tests\BaseTestCase;

/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 18:34
 */

class ArquivoTest extends BaseTestCase
{
    /**
     * @var Arquivo
     */
    protected $arquivo;

    /**
     * @var Cabecalho
     */
    protected $cabecalho;

    protected $corpo;

    /**
     * @var Rodape
     */
    protected $rodape;

    public function setUp()
    {
        parent::setUp();
        $this->cabecalho = new Cabecalho($this->linhaCabecalho);
        $this->corpo = new Titulo($this->linhaCorpo);
        $this->rodape = new Rodape($this->linhaRodape);

        $arquivo = $this->linhaCabecalho . "\n";
        $arquivo .= $this->linhaCorpo . "\n";
        $arquivo .= $this->linhaRodape;

        $this->arquivo = new Arquivo($arquivo);
    }

    public function testGetCabecalho()
    {
        $this->assertEquals($this->cabecalho, $this->arquivo->getCabecalho(), 'Cabeçalhos inconsistentes');
    }

    public function testGetCorpo()
    {
        $this->assertEquals($this->corpo, $this->arquivo->getCorpo()[0], 'Títulos inconsistentes');
    }

    public function testGetRodape()
    {
        $this->assertEquals($this->rodape, $this->arquivo->getRodape(), 'Rodape inconsistente');
    }

    /**
     * @expectedException Exception
     * @expectedException Arquivo não é referente a empresa correta.
     */
    public function testDeveGerarExceptionComEmpresaIncorreta()
    {
        $this->arquivo->getCabecalho()->setEmpresa('teste');
        $this->arquivo->validaEmpresa();
    }

    public function testValidaImportacao()
    {
        $this->assertEquals(number_format($this->rodape->getValorTotal(), 2), number_format($this->arquivo->getValorTotalEmTitulos(), 2));
    }

}
