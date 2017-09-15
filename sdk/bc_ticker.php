<?php
require_once('create_table.php');
    /*
        -Classe
        Ticker - Objetivo: Responsavel por armazenar e inserir as informacoes de um ticker.
        -Parametros
        high: Maior preço unitário de negociação das últimas 24 horas.
        Tipo: Decimal
        low: Menor preço unitário de negociação das últimas 24 horas.
        Tipo: Decimal
        vol: Quantidade negociada nas últimas 24 horas.
        Tipo: Decimal
        last: Preço unitário da última negociação.
        Tipo: Decimal
        buy: Maior preço de oferta de compra das últimas 24 horas.
        Tipo: Decimal
        sell: Menor preço de oferta de venda das últimas 24 horas.
        Tipo: Decimal
        date: Data e hora da informação em Era Unix 
        ( Seus valores representam a quantidade de segundos a partir do dia 1 de janeiro de 1970)
        Tipo: Inteiro
    */
    class Ticker{
        private $high = 0.0;
        private $low = 0.0;
        private $vol = 0.0;
        private $last = 0.0;
        private $buy = 0.0;
        private $date = "";
        private $date_unix = 0;
        protected $json_url;

        /* 
        Construtor
        */
        public function __construct(){
          $this->json_url = 'https://www.mercadobitcoin.net/api/v2/ticker/';
        }
        /*
         Armazena as informacoes da url referentes ao instante da chamada da funcao.
        */
         public function createInstance(){
          $json = file_get_contents($this->json_url);
          $obj = json_decode($json);
          $ticker = $obj->ticker;
          $this->high = $ticker->high;
          $this->low =  $ticker->low;
          $this->vol =  $ticker->vol;
          $this->last =  $ticker->last;
          $this->buy =  $ticker->buy;
          $this->date_unix = $ticker->date;
          $this->date = gmdate("Y-m-d\ H:i:s",$this->date_unix);
          return $this;
        }
        /*
         Imprime as informacoes
        */
         public function info(){
            echo "High:".$this->high.", Created on: ".$this->date."\n";
        }

        /*
         Salva no banco de dados verificando se o Objeto foi devidamente inicializado.
         */
        public function save(){
            global $conn;
            $n_empty = 0;
            foreach($this as $key => $value){
                if($value == 0 || $value == 0.0){
                    $n_empty=$n_empty+1;
                }
            }
            if($n_empty>5)return ;
            $sql = "INSERT INTO TICKER (high, low, vol, last, buy, date)
            VALUES($this->high, $this->low, $this->vol, $this->last, $this->buy, $this->date_unix)";
            if ($conn->query($sql)==TRUE) {
                echo "New record created successfully\n";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn)."\n";
            }
        }

        /*
         Retorna as informacoes armazenadas no banco de dados referentes a uma data em Era Unix
         caso a data($date) informada não esteja contida no Banco de dados a função retorna
         um objeto vazio, e não altera qualquer atributo do Objeto Ticker que chamou a função.
        */
        public function getByDate($date){
            global $conn;
            $sql = "SELECT * FROM TICKER where (date > $date-60) AND (date < $date+60) order by date asc limit 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $this->high = $row['high'];
               $this->low =  $row['low'];
               $this->vol =  $row['vol'];
               $this->last =  $row['last'];
               $this->buy =  $row['buy'];
               $this->date_unix = $row['date'];
               $this->date = gmdate("Y-m-d\ H:i:s",$this->date_unix);
            }
            else {
                return null;
            }
            return $this;
        }
        /*
          Retorna um array contendo os Ticker por intervalo de um periodo, determinado pelo seu
          Inicio($date_b) e fim($date_e) em Era Unix
          e o intervalo ($interval), todos em segundos.
          Obs: tempo minimo de intervalo entre cada um dos ticker obtidos é 60s
        */
        public function getByPeriod($date_b,$date_e, $interval){
            $array_ticker = array();
            if($interval<60)$interval = 60;
            for($i_date = $date_b; $i_date < $date_e; $i_date = $i_date+$interval){
              $aux_ticker = new Ticker();
                $new_element = $aux_ticker->getByDate($i_date);
                if($new_element!=null)
                array_push($array_ticker,$new_element);             
            }
            return $array_ticker;
        }

        public function getHigh(){
            return $this->high;
        }
        public function getLow(){
            return $this->low;
        }
        public function getVol(){
            return $this->low;
        }
        public function getLast(){
            return $this->last;
        }
        public function getBuy(){
            return $this->buy;
        }
        public function getDateUnix(){
            return $this->date_unix;
        }
        public function getDate(){
            return $this->date;
        }
    }


?>
