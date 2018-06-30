<?php 

namespace Unipago;

class ProcessamentoRetorno {

    /**
     * @var Arquivo
     */
    private $_arquivo;

    public function __construct($configuracao) {
        $this->_arquivo = new Arquivo(file_get_contents($configuracao->toArray()['local_arquivo']));
    }

    public function processar() {

        try{
            $this->_arquivo->validaEmpresa();
            echo "Iniciando processamento do arquivo do dia : " . $this->_arquivo->getCabecalho()->getData()->format('Y-m-d');

            $this->_arquivo->processaTitulos();
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        exit;

            switch ($tipo_linha) {
                default:
                    $valorTotal = substr($todoArquivo[$i], 220, 14) / 100;

                    $totalDoArquivo = 0;
                    for ($i=0; $i < count($todoArquivo); $i++) { 
                        $totalDoArquivo += substr($todoArquivo[$i], 152, 13) / 100; 
                    }
                    
                    if (number_format($valorTotal, 2) != number_format($totalDoArquivo, 2)) {
                        throw new \Exception("Arquivo inconsistente");
                    } else {
                        echo "arquivo importado com sucesso \n";
                    }

                    break;
            }
    }
}
