<?php 

namespace Unipago;

use Unipago\model\Arquivo;

class ProcessamentoRetorno {

    /**
     * @var Arquivo
     */
    private $_arquivo;

    public function __construct($configuracao) {
        try{
            $this->_arquivo = new Arquivo(file_get_contents($configuracao->toArray()['local_arquivo']));
        }catch (\Exception $e){
            echo "Arquivo enviado não possui formatação correta: " . $e->getMessage();
        }
    }

    public function processar() {

        try{
            echo "Iniciando processamento do arquivo do dia : " . $this->_arquivo->getCabecalho()->getData()->format('Y-m-d');

            $this->_arquivo->validaEmpresa();
            $this->_arquivo->processaTitulos();
            $this->_arquivo->validaImportacao();
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}
