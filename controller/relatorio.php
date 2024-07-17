<?php
    session_start();

    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] == false){
        header("Location: ../index.php");
    }else{
        include_once ("../dao/clsConexao.php");
        include_once ("../model/clsCredores.php");
        include_once ("../dao/clsCredoresDAO.php");
        include_once ("../model/clsBases.php");
        include_once ("../dao/clsBasesDAO.php");
        include_once ("../model/clsDespesas.php");
        include_once ("../dao/clsDespesasDAO.php");
        include_once ("../model/clsLancamentos.php");
        include_once ("../dao/clsLancamentosDAO.php");
   
        require_once("../FPDF/fpdf.php"); // Biblioteca para gerar PDF

        //define('FPDF_FONTPATH', 'FPDF/font/');

        $pdf = new FPDF("L", "mm", "A4");
		$pdf->SetFont("arial","", 14 );
		$pdf->SetTextColor(0,0,0);
		$pdf->SetY("-1");
		$pdf->Cell(0,0,'',0,1,'L'); 

        if (isset($_REQUEST["credores"]) and ($_REQUEST["txtCredores"])){
            $idcredor = $_POST["txtCredores"];
    		$lancamentos = lancamentosDAO::getLancamentosbyIdCredor($idcredor);

			if ($_POST["opcao_relatorio"] == "csv"){
				if( count($lancamentos) == 0){
				//MENSAGEM DE NENHUM LANÇAMENTO NAQUELE CREDOR
				echo "<script>alert('Nenhum lançamento cadastrado com o credor selecionado!');window.location.replace('relatorioLancamentos.php');</script>"; 
				
				}else{

				$nomeArquivo = "relatorioCredores_".date("d"."_"."m"."_"."Y").".csv";
				header('Content-Type: application/csv');
				header("Content-Disposition: attachment; filename=$nomeArquivo");
				$fp = fopen('php://output', 'w');

				$colunas = array("id" , "Mês" , "Credor" , "Base" , "Despesa" ,
                "Vencimento" , "Valor líquido" , "Multa", "Juros", "Correção", "Valor total");
				fputcsv($fp, $colunas );

				foreach ($lancamentos as $lista) {
					fputcsv($fp, $lista->getArrayCSV() );
				}
				fclose($fp);
				}		

			}else{
				if( count($lancamentos) == 0){
					$pdf->SetX(40);
					$pdf->SetY(100);
					$pdf->MultiCell(170, 10, utf8_decode("Nenhum Lançamento Cadastrado!"), 2, "C",);
				}else{
					foreach($lancamentos as $lista){
					$nomeCredor = ($lista->credores->nome);
					}
					
					$pdf->SetFont('Arial','B',8);
					$pdf->SetY("20");
					$pdf->SetX("5");
					$pdf->Cell(285,10,utf8_decode('Relatório por Credor - '. $nomeCredor), 1, 1, "C");
					
					$pdf->SetFont('Arial','B',8);
					$pdf->SetY("30");
					$pdf->SetX("5");
					$pdf->Cell(15,10,utf8_decode('Código'), 1, 1, "C");

					$pdf->SetY("30");
					$pdf->SetX("20");
					$pdf->Cell(20,10,utf8_decode('Mês'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("40");
					$pdf->Cell(90,10,utf8_decode('Base'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("130");
					$pdf->Cell(65,10,utf8_decode('Despesa'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("195");
					$pdf->Cell(20,10,utf8_decode('Vencimento'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("215");
					$pdf->Cell(15,10,utf8_decode('VLiq'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("230");
					$pdf->Cell(15,10,utf8_decode('Multa'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("245");
					$pdf->Cell(15,10,utf8_decode('Juros'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("260");
					$pdf->Cell(15,10,utf8_decode('Correção'),1,1,'C'); 

					$pdf->SetY("30");
					$pdf->SetX("275");
					$pdf->Cell(15,10,utf8_decode('VTotal'),1,1,'C'); 


					$pdf->SetFont('Arial','I',8);
					$pdf->SetTextColor(0,0,0);
					$y = 40;
			
					foreach($lancamentos as $lanc){
						$pdf->SetY($y);
						$pdf->SetX("5");
						$pdf->Cell(15,10, $lanc->id, 1, 1, 'C');
						
						$pdf->SetY($y);
						$pdf->SetX("20");
						$pdf->Cell(20,10,utf8_decode($lanc->mes),1,1,'C'); 
						
						$pdf->SetY($y);
						$pdf->SetX("40");
						$pdf->Cell(90,10, utf8_decode($lanc->bases->nome), 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("130");
						$pdf->Cell(65,10, utf8_decode($lanc->despesas->nome), 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("195");
						$pdf->Cell(20,10, $lanc->vencimento, 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("215");
						$pdf->Cell(15,10, 'R$ '.$lanc->valor_liquido, 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("230");
						$pdf->Cell(15,10, 'R$ '.$lanc->multa, 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("245");
						$pdf->Cell(15,10, 'R$ '.$lanc->juros, 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("260");
						$pdf->Cell(15,10, 'R$ '.$lanc->correcao, 1, 1, 'C');

						$pdf->SetY($y);
						$pdf->SetX("275");
						$pdf->Cell(15,10, 'R$ '.$lanc->valor_total, 1, 1, 'C');
												
						$y += 10;
					}
				}   
				$pdf->Output("relatorio.pdf", "I");
			}
		}

		if (isset($_REQUEST["bases"]) and ($_REQUEST["txtBases"])){
            $idBase = $_POST["txtBases"];
			$lancamentos = lancamentosDAO::getLancamentosbyIdBase($idBase);

			if ($_POST["opcao_relatorio"] == "csv"){
				if( count($lancamentos) == 0){
					//MENSAGEM DE NENHUM LANÇAMENTO NAQUELA BASE
					echo "<script>alert('Nenhum lançamento cadastrado com a base selecionada!');window.location.replace('relatorioLancamentos.php');</script>"; 
				}else{
				
				$nomeArquivo = "relatorioBases_".date("d"."_"."m"."_"."Y").".csv";
				header('Content-Type: application/csv');
				header("Content-Disposition: attachment; filename=$nomeArquivo");
				$fp = fopen('php://output', 'w');

				$colunas = array("id" , "Mês" , "Credor" , "Base" , "Despesa" ,
                "Vencimento" , "Valor líquido" , "Multa", "Juros", "Correção", "Valor total");
				fputcsv($fp, $colunas );

				foreach ($lancamentos as $lista) {
					fputcsv($fp, $lista->getArrayCSV() );
				}
				fclose($fp);	
				}
			}else{
               
            if( count($lancamentos) == 0){
        		$pdf->SetX(40);
		        $pdf->SetY(100);
		        $pdf->MultiCell(170, 10, utf8_decode("Nenhum Lançamento Cadastrado!"), 2, "C",);
    		}else{
				foreach($lancamentos as $lista){
				$nomeBase = ($lista->bases->nome);
				}
				
                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("20");
            	$pdf->SetX("5");
            	$pdf->Cell(285,10,utf8_decode('Relatório por Base - '. $nomeBase), 1, 1, "C");
                
                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("30");
            	$pdf->SetX("5");
            	$pdf->Cell(15,10,utf8_decode('Código'), 1, 1, "C");

            	$pdf->SetY("30");
            	$pdf->SetX("20");
               	$pdf->Cell(20,10,utf8_decode('Mês'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("40");
                $pdf->Cell(90,10,utf8_decode('Credor'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("130");
                $pdf->Cell(65,10,utf8_decode('Despesa'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("195");
                $pdf->Cell(20,10,utf8_decode('Vencimento'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("215");
                $pdf->Cell(15,10,utf8_decode('VLiq'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("230");
                $pdf->Cell(15,10,utf8_decode('Multa'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("245");
                $pdf->Cell(15,10,utf8_decode('Juros'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("260");
                $pdf->Cell(15,10,utf8_decode('Correção'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("275");
                $pdf->Cell(15,10,utf8_decode('VTotal'),1,1,'C'); 

				$pdf->SetFont('Arial','I',8);
                $pdf->SetTextColor(0,0,0);
		        $y = 40;
        
                foreach($lancamentos as $lanc){
		            $pdf->SetY($y);
			        $pdf->SetX("5");
			        $pdf->Cell(15,10, $lanc->id, 1, 1, 'C');
                    
			        $pdf->SetY($y);
			        $pdf->SetX("20");
			        $pdf->Cell(20,10,utf8_decode($lanc->mes),1,1,'C'); 
			        
                    $pdf->SetY($y);
			        $pdf->SetX("40");
			        $pdf->Cell(90,10, utf8_decode($lanc->credores->nome), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("130");
			        $pdf->Cell(65,10, utf8_decode($lanc->despesas->nome), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("195");
			        $pdf->Cell(20,10, $lanc->vencimento, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("215");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_liquido, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("230");
			        $pdf->Cell(15,10, 'R$ '.$lanc->multa, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("245");
			        $pdf->Cell(15,10, 'R$ '.$lanc->juros, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("260");
			        $pdf->Cell(15,10, 'R$ '.$lanc->correcao, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("275");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_total, 1, 1, 'C');
                                        
                    $y += 10;
		        }
            }   
			$pdf->Output("relatorio.pdf", "I");
		}
	}


		if (isset($_REQUEST["despesas"]) and ($_REQUEST["txtDespesas"])){
            $idDespesa = $_POST["txtDespesas"];
			$lancamentos = lancamentosDAO::getLancamentosbyIdDespesa($idDespesa);

			if ($_POST["opcao_relatorio"] == "csv"){
				if( count($lancamentos) == 0){
					//MENSAGEM DE NENHUM LANÇAMENTO NAQUELA DESPESA
					echo "<script>alert('Nenhum lançamento cadastrado com a despesa selecionada!');window.location.replace('relatorioLancamentos.php');</script>"; 
				}else{
				
				$nomeArquivo = "relatorioDespesas_".date("d"."_"."m"."_"."Y").".csv";
				header('Content-Type: application/csv');
				header("Content-Disposition: attachment; filename=$nomeArquivo");
				$fp = fopen('php://output', 'w');

				$colunas = array("id" , "Mês" , "Credor" , "Base" , "Despesa" ,
                "Vencimento" , "Valor líquido" , "Multa", "Juros", "Correção", "Valor total");
				fputcsv($fp, $colunas );

				foreach ($lancamentos as $lista) {
					fputcsv($fp, $lista->getArrayCSV() );
				}
				fclose($fp);	
				}
			}else{
				if( count($lancamentos) == 0){
        		$pdf->SetX(40);
		        $pdf->SetY(100);
		        $pdf->MultiCell(170, 10, utf8_decode("Nenhum Lançamento Cadastrado!"), 2, "C",);
    			}else{
				foreach($lancamentos as $lista){
				$nomeDespesa = ($lista->despesas->nome);
				}
				
                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("20");
            	$pdf->SetX("5");
            	$pdf->Cell(285,10,utf8_decode('Relatório por Despesa - '. $nomeDespesa), 1, 1, "C");
                
                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("30");
            	$pdf->SetX("5");
            	$pdf->Cell(15,10,utf8_decode('Código'), 1, 1, "C");

            	$pdf->SetY("30");
            	$pdf->SetX("20");
               	$pdf->Cell(20,10,utf8_decode('Mês'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("40");
                $pdf->Cell(90,10,utf8_decode('Credor'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("130");
                $pdf->Cell(65,10,utf8_decode('Base'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("195");
                $pdf->Cell(20,10,utf8_decode('Vencimento'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("215");
                $pdf->Cell(15,10,utf8_decode('VLiq'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("230");
                $pdf->Cell(15,10,utf8_decode('Multa'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("245");
                $pdf->Cell(15,10,utf8_decode('Juros'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("260");
                $pdf->Cell(15,10,utf8_decode('Correção'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("275");
                $pdf->Cell(15,10,utf8_decode('VTotal'),1,1,'C'); 

				$pdf->SetFont('Arial','I',8);
                $pdf->SetTextColor(0,0,0);
		        $y = 40;
        
                foreach($lancamentos as $lanc){
		            $pdf->SetY($y);
			        $pdf->SetX("5");
			        $pdf->Cell(15,10, $lanc->id, 1, 1, 'C');
                    
			        $pdf->SetY($y);
			        $pdf->SetX("20");
			        $pdf->Cell(20,10,utf8_decode($lanc->mes),1,1,'C'); 
			        
                    $pdf->SetY($y);
			        $pdf->SetX("40");
			        $pdf->Cell(90,10, utf8_decode($lanc->credores->nome), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("130");
			        $pdf->Cell(65,10, utf8_decode($lanc->bases->nome), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("195");
			        $pdf->Cell(20,10, $lanc->vencimento, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("215");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_liquido, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("230");
			        $pdf->Cell(15,10, 'R$ '.$lanc->multa, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("245");
			        $pdf->Cell(15,10, 'R$ '.$lanc->juros, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("260");
			        $pdf->Cell(15,10, 'R$ '.$lanc->correcao, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("275");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_total, 1, 1, 'C');
                                        
                    $y += 10;
		        }
            }
			$pdf->Output("relatorio.pdf", "I");  
		} 
	}

		if (isset($_REQUEST["periodo"]) && ($_REQUEST["txtInicial"]) && ($_REQUEST["txtFinal"])){
            $inicio = $_POST["txtInicial"];			
			$fim = $_POST["txtFinal"];
			$lancamentos = lancamentosDAO::getLancamentosbyPeriodo($inicio, $fim);

			if ($_POST["opcao_relatorio"] == "csv"){
				if( count($lancamentos) == 0){
					//MENSAGEM DE NENHUM LANÇAMENTO NAQUELE PERÍODO
					echo "<script>alert('Nenhum lançamento cadastrado no período selecionado!');window.location.replace('relatorioLancamentos.php');</script>"; 
				}else{
				
				$nomeArquivo = "relatorioPeriodo_".date("d"."_"."m"."_"."Y").".csv";
				header('Content-Type: application/csv');
				header("Content-Disposition: attachment; filename=$nomeArquivo");
				$fp = fopen('php://output', 'w');
						
				$colunas = array("id" , "Mês" , "Credor" , "Base" , "Despesa" ,
                "Vencimento" , "Valor líquido" , "Multa", "Juros", "Correção", "Valor total");
				fputcsv($fp, $colunas );

				foreach ($lancamentos as $lista) {
					fputcsv($fp, $lista->getArrayCSV() );
				}
				fclose($fp);	
				}
			}else{
			               
            if( count($lancamentos) == 0){
        		$pdf->SetX(40);
		        $pdf->SetY(100);
		        $pdf->MultiCell(170, 10, utf8_decode("Nenhum Lançamento Cadastrado!"), 2, "C",);
    		}else{
				$inicio = date('d/m/Y', strtotime($inicio));	
				$fim = date('d/m/Y', strtotime($fim));	

                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("20");
            	$pdf->SetX("5");
            	$pdf->Cell(285,10,utf8_decode('Relatório por Período - ' . $inicio . ' a ' . $fim), 1, 1, "C");
                
                $pdf->SetFont('Arial','B',8);
        		$pdf->SetY("30");
            	$pdf->SetX("5");
            	$pdf->Cell(15,10,utf8_decode('Código'), 1, 1, "C");

            	$pdf->SetY("30");
            	$pdf->SetX("20");
               	$pdf->Cell(20,10,utf8_decode('Mês'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("40");
                $pdf->Cell(90,10,utf8_decode('Credor'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("130");
                $pdf->Cell(65,10,utf8_decode('Base'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("195");
                $pdf->Cell(20,10,utf8_decode('Vencimento'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("215");
                $pdf->Cell(15,10,utf8_decode('VLiq'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("230");
                $pdf->Cell(15,10,utf8_decode('Multa'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("245");
                $pdf->Cell(15,10,utf8_decode('Juros'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("260");
                $pdf->Cell(15,10,utf8_decode('Correção'),1,1,'C'); 

                $pdf->SetY("30");
                $pdf->SetX("275");
                $pdf->Cell(15,10,utf8_decode('VTotal'),1,1,'C'); 

				$pdf->SetFont('Arial','I',8);
                $pdf->SetTextColor(0,0,0);
		        $y = 40;
        
                foreach($lancamentos as $lanc){
		            $pdf->SetY($y);
			        $pdf->SetX("5");
			        $pdf->Cell(15,10, $lanc->id, 1, 1, 'C');
                    
			        $pdf->SetY($y);
			        $pdf->SetX("20");
			        $pdf->Cell(20,10,utf8_decode($lanc->mes),1,1,'C'); 
			        
                    $pdf->SetY($y);
			        $pdf->SetX("40");
			        $pdf->Cell(90,10, utf8_decode($lanc->credores->nome), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("130");
			        $pdf->Cell(65,10, utf8_decode($lanc->bases->nome), 1, 1, 'C');

					$dataVenc = $lanc->vencimento;
					$dataVenc = date('d/m/Y', strtotime($dataVenc));	

                    $pdf->SetY($y);
			        $pdf->SetX("195");
			        $pdf->Cell(20,10, ($dataVenc), 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("215");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_liquido, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("230");
			        $pdf->Cell(15,10, 'R$ '.$lanc->multa, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("245");
			        $pdf->Cell(15,10, 'R$ '.$lanc->juros, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("260");
			        $pdf->Cell(15,10, 'R$ '.$lanc->correcao, 1, 1, 'C');

                    $pdf->SetY($y);
			        $pdf->SetX("275");
			        $pdf->Cell(15,10, 'R$ '.$lanc->valor_total, 1, 1, 'C');
                                     
                    $y += 10;
		        }
			}
			$pdf->Output("relatorio.pdf", "I"); 
        }  			
	}
}

	




