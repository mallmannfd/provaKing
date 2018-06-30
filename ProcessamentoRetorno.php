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
            
        }catch (\Exception $e){
            echo $e->getMessage();
        }
        exit;

            switch ($tipo_linha) {

                case 'corpo':
                    $nosso_numero = substr($todoArquivo[$i], 62, 8);
                    $valorPago = substr($todoArquivo[$i], 152, 13) / 100; 
                    $tarifa = substr($todoArquivo[$i], 175, 13) / 100; 
                    $juros = substr($todoArquivo[$i], 266, 13) / 100; 
                    $creditado = substr($todoArquivo[$i], 253, 13) / 100; 
                    $ocorrencia = substr($todoArquivo[$i], 108, 2); 
                    
                    $arrayOcorrencias = array('06','09');

                    if (in_array($ocorrencia, $arrayOcorrencias)) {
                        if (number_format($creditado,2) == number_format($valorPago + $juros - $tarifa, 2)) {
                            echo "Pagamento do título $nosso_numero efetuado com sucesso \n";
                            ApiPagamentos::baixaTitulo($nosso_numero, $valorPago);
                        } else {
                            echo "Valor incorreto \n";
                        }
                    } else {
                        echo "Tipo de entrada não encontrado \n";
                    }

                    break;
                
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
