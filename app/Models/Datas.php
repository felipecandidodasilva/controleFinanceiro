<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormaPagamento;

class Datas extends Model
{
    use HasFactory;

    public static function obterPrimeiroDiaDoMes($data) {
        // Converte a data para timestamp
        $timestamp = strtotime($data);
      
        // Define o primeiro dia do mês
        $primeiroDiaDoMes = strtotime('first day of this month', $timestamp);
      
        // Formata o timestamp para a data no formato desejado
        return date('Y-m-d', $primeiroDiaDoMes);
      }

    public static function obterUltimoDiaDoMes($data) {
        return date('Y-m-t', strtotime($data));
      }
      
    public static function obterDia($data) {
      
      $partesData = explode('-', $data);
      // dd( $partesData);
      return $partesData[2];

      }
      
    public static function alterarDia($dataOriginal,$novoDia) {
      
      // Separa a data em partes
      $partesData = explode('-', $dataOriginal);
    
      // Ajusta o dia
      $partesData[2] = $novoDia;
    
      // Reconstrói a string da data
      $dataModificada = implode('-', $partesData);
    
      // Formata a data final
      return date('Y-m-d', strtotime($dataModificada));
    }

    public static function adicionaMes($data){
      // dd($data);
      
      $dataObject = new DateTime($data); // Cria um objeto DateTime
      // Soma 1 mês ao objeto DateTime
      $dataObject->modify('+1 month');
      // Ajusta o dia para o último dia do novo mês, se necessário
      if ($dataObject->format('d') < date("d", strtotime($data))) {
          $dataObject->modify('-1 day');
          $dataObject->modify('last day of this month');
      }
      $dataVencimento = $dataObject->format('Y-m-d');
      return $dataVencimento;
    }

    public static function retornaPrimeiroVencimento($forma_pagamento_id, $dt_compra)  
    {

        $dtPrimeiroVencimento = $dt_compra;
        
        $formaPagamento = FormaPagamento::find($forma_pagamento_id);


        // dd($formaPagamento,$dtPrimeiroVencimento);

        $diaVencimento = $formaPagamento->diavencimento;

        if ($diaVencimento) {

            // Forma de pagamento tem dia vencimento cadastrada

            $diaCompra = Datas::obterDia($dt_compra);
            $melhorDia = $formaPagamento->diacompra;
            $diaVencimento = $formaPagamento->diavencimento;

            //
            $dtPrimeiroVencimento = Datas::alterarDia( $dtPrimeiroVencimento,$diaVencimento);

            if ( $melhorDia < $diaVencimento){

               // Passou do dia da compra próximo vencimento mes que vem
               if ($diaCompra >= $melhorDia)  {
                 $dtPrimeiroVencimento = Datas::adicionaMes($dtPrimeiroVencimento);
                }
                
              }
              if ( $melhorDia > $diaVencimento){
                
                if ($diaCompra >= $melhorDia)  {
                  // Passou do dia da compra próximo vencimento a 2 meses 
                  // echo $dtPrimeiroVencimento;
                  $dtPrimeiroVencimento = Datas::adicionaMes($dtPrimeiroVencimento);
                  // echo $dtPrimeiroVencimento;
                  $dtPrimeiroVencimento = Datas::adicionaMes($dtPrimeiroVencimento);
                  // echo $dtPrimeiroVencimento;
                  // dd('fim');
                } else{
                  // Não passou do dia da compra próximo vencimento mes que vem
                  $dtPrimeiroVencimento = Datas::adicionaMes($dtPrimeiroVencimento);
                  
                }

            }
        }

        return $dtPrimeiroVencimento;
    }
}
