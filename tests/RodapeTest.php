<?php

use Unipago\tests\BaseTestCase;
use Unipago\model\Rodape;
/**
 * Created by PhpStorm.
 * User: mallmann
 * Date: 04/07/18
 * Time: 17:35
 */

class RodapeTest extends BaseTestCase
{
    /**
     * @var Rodape
     */
    protected $rodape;

    public function setUp()
    {
        parent::setUp();
        $this->rodape = new Rodape($this->linhaRodape);
    }

    public function testGetValorTotal()
    {
        $this->assertEquals(14112.49, $this->rodape->getValorTotal(), 'Valor inconsistente');
    }
}
